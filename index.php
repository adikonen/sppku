<?php

phpinfo();
die;
if (! session_id()) {
    session_start();
}

require_once 'app/_init.php';
new App;