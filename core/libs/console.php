<?php

/**
 * Console
 * @author nelson rojas
 * @abstract
 * Clase que permite escribir logs
 */
class Console {

    const LOGS_DIR = APP_PATH . 'temp' . DS . 'logs';

    protected static $logsDir = self::LOGS_DIR;

    public static function setLogsDir(string $path) {
        self::$logsDir = $path;
    }

    /**
     * Escribe dentro del archivo de log de acuerdo a la fecha del sistema
     * @param string $mensaje
     * @return void
     * @throws Exception
     */
    public static function writeLog(string $mensaje) {
        try {
            $arch = fopen(realpath(self::$logsDir) .
                    DS . "log_" . date("Y-m-d") . ".txt", "a+");

            fwrite($arch, "[" . date("Y-m-d H:i:s.u") . " " .
                    $mensaje . "\n");
            fclose($arch);
        } catch (\Exception $ex) {
            throw (new \Exception('Imposible escribir en el directorio ' . self::LOGS_DIR));
        }
    }

}
