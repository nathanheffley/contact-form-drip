<?php

namespace nathanheffley\contactformdrip\models;

use craft\base\Model;

class Settings extends Model
{
    public $accountId;
    public $apiToken;
    public $eventName;

    public function rules()
    {
        return [
            [['accountId', 'apiToken', 'eventName'], 'required'],
            [['accountId', 'apiToken', 'eventName'], 'string'],
        ];
    }
}