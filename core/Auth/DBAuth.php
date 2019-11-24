<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 17/07/2015
 * @Time    : 12:21
 * @File    : DBAuth.php
 * @Version : 1.0
 */

namespace Core\Auth;

use App\Controller\UsersController;
use Core\Database\Database;

class DBAuth {

    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserId(){
        if ($this->logged()){
            return $_SESSION['id'];
        }
        return false;
    }

    /**
     * @param $username
     * @param $password
     * @ereturn boolean
     * @return bool
     */
    public function login($username, $password) {
        $user = $this->db->prepare("SELECT * FROM ARDEN_users WHERE pseudo = ? AND deleted = 'N'", [$username], null, true);
        $checkBan = $this->db->prepare("SELECT * FROM ARDEN_ban WHERE pseudo = ?", [$username], null, true);
        if(!$checkBan){
            if($user) {
                if($user->password === UsersController::cryptPass($password)) {
                    $_SESSION['id'] = $user->id;
                    $_SESSION['pseudo'] = $user->pseudo;
                    $_SESSION['grade'] = $user->grade;
                    $_SESSION['user_id'] = $user->user_id;
                    $_SESSION['avatar'] = ''. $user->avatar;

                    return true;
                }
            }
        }

            return false;
    }

    public function logged(){
        return isset($_SESSION['id']);
    }
}