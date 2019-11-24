<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 17/07/2015
 * @Time    : 15:51
 * @File    : Controller.php
 * @Version : 1.0
 */

namespace Core\Controller;

use App;
use Core\Auth\DBAuth;
use Core\Server\Server;
use Core\HTML\BootstrapForm;

class Controller extends Server{

    /**
     * @var string Chemin du dossier qui contient les vues
     */
    protected $viewPath;

    /**
     * @var string Chemin du fichier template
     */
    protected $template;

    /**
     * @param $view Rend la vue à afficher
     */
    protected function render($view, $variables = []){
        ob_start();
        extract($variables);
        require ($this->viewPath. str_replace('.', '/', $view). '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template .'.php');
    }

    /**
     * Function pour interdir l'accès à certaines page comme l'administration
     */
    protected function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        $errors = false;
        if(!empty($_POST)){
            $auth = new DBAuth(App::getInstance()->getDb());
            if($auth->login($_POST['pseudo'], $_POST['password'])){
                header('Location:?page=admin.news.index');
            } else {
                $errors = true;
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'errors'));
        die("Accès Interdit. Veuillez vous connecter");
    }

    /**
     * Function pour dire qu'une page n'existe pas
     */
    protected function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

    protected function forbiddenToMember(){
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb());
        if($auth->logged()) {
            header('Location: /');
        }
    }

    protected function forbiddenToVisitor(){
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb());
        if(!$auth->logged()) {
            header('Location: /');
        }
    }

    protected function forbiddenToWebBrowser(){
        if(!empty($_GET['page'])){
            header('Location: ?');
        }
    }
}
