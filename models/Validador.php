<?php

namespace app\models;

use yii\base\Model;

class Validador extends Model
{
    public $xml;
    public $xsd;

    public function rules()
    {
        return [
            [['xml', 'xsd'], 'required'],
        ];
    }
}