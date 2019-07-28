<?php


namespace fw\core;


use Exception;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        set_error_handler([$this,'errorHandler']);
        // включаем буфферизацию вывода (вывод скрипта сохраняется во внутреннем буфере)
        ob_start();
        register_shutdown_function([$this,'fatalErrorHandler']);
        set_exception_handler([$this,'exceptionHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline){
        $this->logErrors($errstr, $errfile, $errline);
        if (DEBUG || in_array($errno,[E_USER_ERROR,E_RECOVERABLE_ERROR])){
            $this->displayError($errno, $errstr, $errfile, $errline);
        }

        return true;

    }

    public function fatalErrorHandler(){
        $error = error_get_last() ;
        // если была ошибка и она фатальна
        if ( !empty($error) && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))
        {

            $this->logErrors($error['message'], $error['file'], $error['line']);
            // очищаем буффер (не выводим стандартное сообщение об ошибке)
            ob_end_clean();
            // запускаем обработчик ошибок
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        }
        else
        {
            // отправка (вывод) буфера и его отключение
            ob_end_flush();
        }
    }

    protected function displayError($errno, $errstr, $errfile, $errline,$response  = 500){
        http_response_code($response);
        if($response === 404 && !DEBUG){
            require WWW . '/errors/404.php';
            die;
        }
        if(DEBUG){
            require WWW . "/errors/dev.php";
        }else{
            require WWW . "/errors/prod.php";
        }
        die;
    }

    protected function logErrors($message = "",$file = '',$line =''){
        error_log("[".date('Y-m-d H:i:s')."] Текст ошибки: {$message} Файл: {$file } Cтрока: {$line} \n=====================\n",3,LOG . '/errors.log');
    }

    /**
     * @param Exception $e
     */
    public function exceptionHandler(Exception $e){
        $this->logErrors($e->getMessage(),$e->getFile(),$e->getLine());

        $this->displayError('Исключение',$e->getMessage(),$e->getFile(),$e->getLine(),$e->getCode());
    }
}