<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 08/11/2015
 * @Time    : 13:39
 * @File    : Logger.php
 * @Version : 1.0
 */

// log level
define('_ERROR', 1);
define('_WARNING', 2);
define('_NOTICE', 3);
define('_INFO', 4);
define('_SYSTEM', 5);
define('_DEFAULT', 6);

// generic global logging shortcuts for different level of verbosity
function _error($msg) { return Logger::log($msg, _ERROR); }
function _warning($msg) { return Logger::log($msg, _WARNING); }
function _notice($msg) { return Logger::log($msg, _NOTICE); }
function _info($msg) { return Logger::log($msg, _INFO); }
function _system($msg) { return Logger::log($msg, _SYSTEM); }
function _default($msg) { return Logger::log($msg, _DEFAULT); }

// generic global terminal output colorize method
// finally sends colorized message to terminal using error_log/1
// this method is mainly to escape $msg from file:line and time
// prefix done by _debug, _error, ... methods
function _colorize($msg, $verbosity) { error_log(Logger::colorize($msg, $verbosity)); }

class Logger {

    public static $level = _DEFAULT;
    public static $path = null;
    public static $max_log_size = 1000;

    protected static $colors = array(
        /**
         * 31=> red
         * 32=> green
         * 33=> yellow
         * 34=> blue
         * 35=> pink
         * 36=> light blue
         * 37=> white
         */
        1 => 31,	// error: red
        2 => 35,	// warning: pink
        3 => 33,	// notice: yellow
        4 => 32,	// info: green
        5 => 36,		// system: blue
        6 => 37,		// debug: white
    );

    public static function log($msg, $verbosity=1) {
        if($verbosity <= self::$level) {
            $bt = debug_backtrace(); array_shift($bt); $callee = array_shift($bt);
            $msg = basename($callee['file'], '.php').":".$callee['line']." - ".@date('Y-m-d H:i:s')." - ".$msg;
            return $message = self::colorize($msg, $verbosity). "\n";
           /* $size = strlen($msg);
            if($size > self::$max_log_size) $msg = substr($msg, 0, self::$max_log_size) . ' ...';

            if(isset(self::$path)) error_log($msg . PHP_EOL, 3, self::$path);*/
//            else return $message = date('Y-m-d H:i:s: ') . self::colorize($msg, $verbosity). "\n";
        }
    }

    public static function colorize($msg, $verbosity) {
        return "\033[".self::$colors[$verbosity]."m".$msg."\033";
    }

}
