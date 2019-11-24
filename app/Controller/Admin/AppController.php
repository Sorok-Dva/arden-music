<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 17/07/2015
 * @Time    : 16:02
 * @File    : AppController.php
 * @Version : 1.0
 */

namespace App\Controller\Admin;
use App;
use Core\Auth\DBAuth;

class AppController extends \App\Controller\AppController  {

    protected $template = 'administration';

    public function __construct(){
        parent::__construct();
        $app = App::getInstance();

        $auth = new DBAuth($app->getDb());
        if(!$auth->logged()){
            $this->forbidden();
        }
    }

    protected function loadModel($model_name){
        $this->$model_name =  App::getInstance()->getTable($model_name);
    }

}