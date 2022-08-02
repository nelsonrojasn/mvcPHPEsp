<?php

class Sanitizar {

    private static function stripSlashesDeep($value) {
        $value = is_array($value) ? array_map('static::stripSlashesDeep', $value) : stripslashes($value);
        return $value;
    }

    private static function removeMagicQuotes() {
        $_GET = static::stripSlashesDeep($_GET);
        $_POST = static::stripSlashesDeep($_POST);
        $_COOKIE = static::stripSlashesDeep($_COOKIE);
    }

    /** Check register globals and remove them * */
    private static function unregisterGlobals() {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    public static function ejecutar() {
        static::removeMagicQuotes();
        static::unregisterGlobals();
    }
}
