<?php
defined('SITE_ROOT') ?  : define('SITE_ROOT',__DIR__);
defined('DS') ? : define('DS',DIRECTORY_SEPARATOR);
defined('ASSETS') ?  : define('ASSETS', SITE_ROOT.DS.'assets'.DS);
defined('CLASSES') ?  : define('CLASSES',SITE_ROOT.DS.'classes'.DS);
defined('IMAGES') ?  : define('IMAGES', ASSETS.'images'.DS);

require_once SITE_ROOT.'./dbconfig.php';
require_once SITE_ROOT.'./functions.php';

require_once SITE_ROOT.'./sessionHandler.php';
require_once SITE_ROOT.'./classes/db.php';

