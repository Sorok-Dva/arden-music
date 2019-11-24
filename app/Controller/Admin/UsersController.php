<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 17/07/2015
 * @Time    : 15:56
 * @File    : UsersController.php
 * @Version : 1.0
 */

namespace App\Controller\Admin;

use App\Table;
use App\Controller;
use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;
use \App;

class UsersController extends AppController {

    public function __construct() {
        parent::__construct();
        $this->loadModel('User');
    }

    /**
     * @param $password string Encrypte de façon non récursive un mot de passe
     * @return string Le mot de passe enrypté
     */
    public static function cryptPass($password) {
        $encryptedPassword = crypt($password,'$2y$10$agthepheardensyliight$');
        return $encryptedPassword;
    }
    /**
     * Connecte un utilisateur
     */
    public function login(){
        $this->forbiddenToMember();
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
    }
    /**
     * Function pour connecter un utilisateur sans passer par la page de connexion (connexion via la box)
     */
    public function loginInstant(){
        $this->forbiddenToMember();
        if(!empty($_POST)){
            $auth = new DBAuth(App::getInstance()->getDb());
            if($auth->login($_POST['pseudo'], $_POST['password'])){
                $this->sendMessagetoCLI("Une session viens d'etre creer pour ". $_SESSION['pseudo'], 4);
                header('Location:?page=game.overview');

            } else {
                $errors = true;
                $form = new BootstrapForm($_POST);
                $this->render('users.login', compact('form', 'errors'));
            }
        }
    }
    /**
     * Deconnecte un utilisateur
     */
    public function logout(){
        $this->sendMessagetoCLI("La session de ". $_SESSION['pseudo'] ." viens d'etre detruite suite a une deconnexion", 2);
        session_unset();
        session_destroy();

        $this->forbiddenToVisitor(); //s'occupe de rediriger l'utilisateur déconnecter vers l'accueil
    }

    /*************************************************************************************/
    /************************** GESTION DES POST EN AJAX *********************************/
    /*************************************************************************************/
    public function AJAX_login($pseudo, $password){
        $this->forbiddenToMember();
        if(!empty($_POST)){
            $auth = new DBAuth(App::getInstance()->getDb());
            if($auth->login($pseudo, $password)){
                $this->sendMessagetoCLI("Une session viens d'etre creer pour ". $_SESSION['pseudo'], 4);
                return true;
            } else {
                return false;
            }
        }
    }
}
