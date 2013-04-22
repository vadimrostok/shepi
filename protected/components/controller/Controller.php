<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/layout';
    public $breadcrumbs = array();

    public function init()
    {
        parent::init();
        
        //Yii::app()->getClientScript()->registerCoreScript('jquery');
        //underscore
        //Yii::app()->getClientScript()->registerScriptFile('//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js');
        //backbone
        //Yii::app()->getClientScript()->registerScriptFile('//cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.10/backbone-min.js');

        if(!isset($_SESSION)) {
            session_start();
        }
    }

    public static function dump()
    {
        echo self::arrDump(func_get_args());
    }

    public static function arrDump($vars)
    {
        $output = '';
        foreach($vars as $item) {
            $output .= '<pre>' . print_r($item, true) . '</pre>';
        }
        return $output;
    }

    public static function relesePath($fullPath) {
        $pathToFile = pathinfo($fullPath);
        $pathToFile = $pathToFile['dirname'];
        if(!is_dir($pathToFile)) {
            mkdir($pathToFile, 0755, true);
        }
        return $fullPath;
    }

    public static function json($obj) {
        $obj['executionTime'] = sprintf('%0.5f', Yii::getLogger()->getExecutionTime());
        echo CJSON::encode($obj);
    }

    public function actionError()
    {
        if($error = Yii::app()->errorHandler->error) {
            echo $error['message'];
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
    }
}