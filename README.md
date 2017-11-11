contact-form-drip
===========

contact-form-drip provides the ability to integrate the [contact-form](https://github.com/craftcms/contact-form) plugin with [Drip](https://www.drip.com/).

## Requirements

This plugin requires Craft CMS 3.0.0-beta.20 or later, and of course craftcms/contact-form 2.0 or later.

This plugin makes calls to Drip's `v2` API.

## Installation

First install the Contact Form plugin, and then require contact-form-drip:

    composer require nathanheffley/contact-form-drip

Make sure to go to your site's Plugin control panel page and install the plugin, and then go to the setting page and enter your Drip account information and custom event name.

## Using A Config File

If you don't want to use the settings page, you can create a `contact-form-drip.php` file in your project's `config/` folder. Inside that file you can set any of the settings that you see on the settings page.

    <?php

    return [
        'accountId' => '1234567',
        'apiToken'  => 'apitokenvalue123456789',
        'eventName' => 'My Custom Event'
    ]