<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 09/12/2015
 * @Time    : 21:13
 * @File    : AppFunctions.php
 * @Version : 1.0
 */
function getNbrUsers(){
    require ('Controller/UsersController.php');
    $users = new \App\Controller\UsersController();

    return $users->getNbrUsers();
}

function r_number($n) {
    // first strip any formatting;
    $n = (0+str_replace(",","",$n));

    // is this a number?
    if(!is_numeric($n)) return false;

    // now filter it;
    if($n>1000000000000) return round(($n/1000000000000),1).' trillion';
    else if($n>1000000000) return round(($n/1000000000),1).' MD';
    else if($n>1000000) return round(($n/1000000),1).' M';
    else if($n>1000) return round(($n/1000),1).' K';

    return number_format($n);
}
