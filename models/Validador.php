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

    public function validateXml($object, $attribute) {    
        $doc = @simplexml_load_string($this->$attribute);
        if(!$doc) {
            $this->addError($attribute, 'XMl inválido');
        }
    }
}