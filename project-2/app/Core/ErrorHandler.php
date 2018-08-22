<?php
namespace App\Core;


class ErrorHandler
{
    private function errorFileLog($errno, $errstr, $errfile, $errline)
    {
        error_log(
            "[".date('Y-m-d H:i:s')."]\n\r\n\rКод ошибки/исключения: $errno\n\r\n\rТекст ошибки: $errstr\n\r\n\rФайл: $errfile | Строка: $errline\n\r\n\r-----------------\n\r\n\r",
            3,
            APP_PATH.'/errors/errors.log'
        );
    }
    public function __construct()
    {
        DEV ? error_reporting(-1) : error_reporting(0);
        set_error_handler([$this, 'errorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->errorFileLog($errno, $errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
        return true;
    }
    protected function displayError($errno, $errstr, $errfile, $errline, int $responseCode = 503)
    {
        http_response_code($responseCode);
        if ($responseCode == 404) {
            require WWW.'/errors/404.html';
            exit;
        }
        require DEV ? WWW.'/errors/dev.php' : WWW.'/errors/prod.php';
        exit;
    }
    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
            $this->errorFileLog($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }
    public function exceptionHandler($e)
    {
        $errno = $e instanceof \Error ? $e->getCode() : 'Exception';
        $this->errorFileLog($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError($errno, $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }
}