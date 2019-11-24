<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 08/11/2015
 * @Time    : 13:07
 * @File    : Server.php
 * @Version : 1.0
 */

namespace Core\Server;

require_once('Logger.php');

class Server {
    /**
     * @param $msg string Message a affiché dans la CLI
     * @param $status int 1 = Erreur, 2 = Warning, 3 = notice, 4 = info, 5 = system, 6|null = debug
     */
    public function sendMessagetoCLI($msg, $status){
        if(USE_CLI == "Y"){
            switch($status):
                case 1:
                    $msg = _error($msg);
                    break;
                case 2:
                    $msg = _warning($msg);
                    break;
                case 3:
                    $msg = _notice($msg);
                    break;
                case 4:
                    $msg = _info($msg);
                    break;
                case 5:
                    $msg = _system($msg);
                    break;
                default:
                    $msg = _default($msg);
                    break;
            endswitch;


            if(!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);

                die("Une erreur lors de la création de connexion au serveur est survenue: [$errorcode] $errormsg \n");
            }

            if(!socket_connect($sock , '213.186.33.40' , 9578))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);

                die("une erreur lors de la connexion au serveur est survenue: [$errorcode] $errormsg \n");
            }

            if( ! socket_send ( $sock , $msg , strlen($msg) , 0))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);

                die("Impossible d'envoyer les données au serveur: [$errorcode] $errormsg \n");
            }
        }
    }

    public static function sendMessagetoCLI_STATIC($msg, $status){
        if(USE_CLI == "Y"){
            switch($status):
                case 1:
                    $msg = _error($msg);
                    break;
                case 2:
                    $msg = _warning($msg);
                    break;
                case 3:
                    $msg = _notice($msg);
                    break;
                case 4:
                    $msg = _info($msg);
                    break;
                case 5:
                    $msg = _system($msg);
                    break;
                default:
                    $msg = _default($msg);
                    break;
            endswitch;


            if(!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);

                die("Une erreur lors de la création de connexion au serveur est survenue: [$errorcode] $errormsg \n");
            }

            if(!socket_connect($sock , '127.0.0.1' , 9578))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);

                die("une erreur lors de la connexion au serveur est survenue: [$errorcode] $errormsg \n");
            }

            if( ! socket_send ( $sock , $msg , strlen($msg) , 0))
            {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);

                die("Impossible d'envoyer les données au serveur: [$errorcode] $errormsg \n");
            }
        }
    }
}