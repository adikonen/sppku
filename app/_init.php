<?php

require_once 'config/config.php';

if (ON_DEVELOPMENT) {
    require_once 'config/development.php';
} else {
    require_once 'config/production.php';
}

require_once 'interfaces/RenderContent.php';
require_once 'core/App.php';
require_once 'core/Database.php';
require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/AdminController.php';
require_once 'core/SiswaController.php';
require_once 'tools/function.php';
require_once 'tools/Request.php';
require_once 'tools/Flasher.php';
require_once 'tools/Role.php';
require_once 'tools/Month.php';
require_once 'tools/ErrorHandler.php';
require_once 'tools/TemplateView.php';