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

    /**
     * http://www.yiiframework.com/extension/is-xml-validator/
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
    **/
    public function validateXml($object, $attribute) {    
        $file = CUploadedFile::getInstance($object, $attribute);
        if ($file) {
            $prev = libxml_use_internal_errors(true);
            $xml = @simplexml_load_file($file->tempName);
            if (!$xml) {
                $errors = array();
                foreach (libxml_get_errors() as $xmlError) {
                    $errors[] = '[LIBXML:' . $xmlError->code . '] ' . $xmlError->message;
                }
                $object->addErrors(array($attribute => $errors));
            }
            libxml_use_internal_errors($prev);
        }
    }
}