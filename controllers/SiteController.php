<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Validador;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Validador();
        $pasta = $this->readDir(__DIR__ . '/../web/xsd/');
        $validate = null;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            libxml_use_internal_errors(true);
            $doc = new \DOMDocument('1.0', 'utf-8');
            $doc->preservWhiteSpace = false;
            $doc->formatOutput = false;
            $doc->loadXml($model->xml, LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);
            
            if(!$doc->schemaValidate(__DIR__ . '/../web/xsd/' . $pasta[$model->xsd])) {
                $validate = libxml_get_errors();
            }

            if(is_null($validate)) {
                $validate = true;
            }
        }
        
        return $this->render('index', ['model' => $model, 'pasta' => $pasta, 'validate' => $validate]);
    }

    private function readDir($dir, $prefix = '') {
        $dir = rtrim($dir, '\\/');
        $result = array();

        $h = opendir($dir);
        while (($f = readdir($h)) !== false) {
            if (substr($f, 0, 1) != '.') {
                if (is_dir("$dir/$f")) {
                    $result = array_merge($result, $this->readDir("$dir/$f", "$prefix$f/"));
                } else {
                    $result[] = $prefix.$f;
                }
            }
        }
        closedir($h);

        return $result;
    }
}
