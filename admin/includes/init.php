<?php

//Korištenje konstanti za path
//Za separator cemo pisati ds umjesto backlash u pathu
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

//Ako bude greska ovdje provjeriti path
define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'gallery');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once(INCLUDES_PATH.DS.'functions.php');
require_once(INCLUDES_PATH.DS.'database_configuration.php');
require_once(INCLUDES_PATH.DS.'database.php');
require_once(INCLUDES_PATH.DS.'db_object.php');
require_once(INCLUDES_PATH.DS.'user.php');
require_once(INCLUDES_PATH.DS.'photo.php');
require_once(INCLUDES_PATH.DS.'comment.php');
require_once(INCLUDES_PATH.DS.'session.php');
require_once(INCLUDES_PATH.DS.'paginate.php');


?>