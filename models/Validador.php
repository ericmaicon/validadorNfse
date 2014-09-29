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
            [['xml'], 'validateXml'],
        ];
    }

    public function validateXml($attribute, $params)
    {  
        $value = $this->$attribute;
        $doc = @simplexml_load_string($value);
        if(!$doc) {
            $this->addError($attribute, 'XMl inválido');
        }
    }
}