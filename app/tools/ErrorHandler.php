<?php

class ErrorHandler
{
    /**
     * @param Exception $err
     * @param string $mesage
     * @param array $context
     * 
     * throw error on development, hide and log the error on staging or production
     */
    public static function log($err, $message, $context = [])
    {
        if (ON_DEVELOPMENT) {
            throw $err;
        }

        $info = "ERROR $message context := ";
        foreach ($context as $k => $v) {
            if (is_array($v)) {
                $v = implode(',',$v);
            }
            $msg = "$k = $v;";
            $info .= $msg;
        };
        $result = $info . 'error message := ' . $err->getMessage();
        error_log($result);
    }
}
