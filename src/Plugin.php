<?php

namespace nathanheffley\contactformdrip;

use Craft;
use yii\base\Event;
use craft\contactform\Mailer;
use nathanheffley\contactformdrip\models\Settings;
use craft\contactform\events\SendEvent;

class Plugin extends \craft\base\Plugin
{
    public $hasCpSettings = true;

    public function init()
    {
        parent::init();

        Event::on(Mailer::class, Mailer::EVENT_AFTER_SEND, function(SendEvent $e) {

            $settings = $this::getInstance()->getSettings();

            // Drip settings
            $accountId = $settings->accountId;
            $apiToken = $settings->apiToken;
            $eventName = $settings->eventName;

            // GuzzleHTTP options
            $client = new \GuzzleHttp\Client();
            $url = 'https://api.getdrip.com/v2/' . $accountId . '/events';

            // Submission variables
            $email = $e->submission->fromEmail;

            // Sending the requests
            $client->request('POST', $url, [
                'auth' => [$apiToken, ''],
                'headers'  => ['content-type' => 'application/vnd.api+json'],
                'body' => json_encode([
                    'events' => [
                        [
                            'email' => $email,
                            'action' => $eventName
                        ]
                    ]
                ])
            ]);
        });
    }

    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    protected function settingsHtml(): string
    {
        // Get and pre-validate the settings
        $settings = $this->getSettings();
        $settings->validate();

        // Get the settings that are being defined by the config file
        $overrides = Craft::$app->getConfig()->getConfigFromFile(strtolower($this->handle));
        return Craft::$app->view->renderTemplate('contact-form-drip/_settings', [
            'settings' => $settings,
            'overrides' => array_keys($overrides),
        ]);
    }
}
