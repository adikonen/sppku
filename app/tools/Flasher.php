<?php

/**
 * a class for handle flash message
 */
class Flasher
{
    /**
     * set the flash message
     * @param string $type
     * @param string $message
     */
    public static function set($type, $message)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message'=> $message
        ];
    }

    /**
     * show the flash message
     */
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            $type = $_SESSION['flash']['type'];
            $message = $_SESSION['flash']['message'];

            echo <<<html
                <div class="alert alert-$type">$message</div>
            html;

            unset($_SESSION['flash']);
        }
    }

}