<?php

//Define the core paths

//DRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for windows, /for unix)
defined('DS')? null: define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT')? null: define('SITE_ROOT', ''.DS.'home'.DS.'reveyzwc');
//defined('SITE_ROOT')? null: define('SITE_ROOT', 'C:'.DS.'wamp'.DS.'www'.DS.'revabode');
//defined('SITE_ROOT')? null: define('SITE_ROOT', 'http://www.revenueabode.com');

//$config_basedir = "http://www.resultant.com/";

defined('LIB_PATH')? null: define('LIB_PATH', SITE_ROOT.DS.'includes');
require_once(LIB_PATH.DS.'config.php');
require_once(LIB_PATH.DS.'functions.php');
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');

//load database related classes

require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'investor.php');
require_once(LIB_PATH.DS.'site_info.php');
require_once(LIB_PATH.DS."pagination.php");
require_once(LIB_PATH.DS.'student.php');
require_once(LIB_PATH.DS.'image_member.php');
require_once(LIB_PATH.DS.'reward.php');
require_once(LIB_PATH.DS.'signal.php');
require_once(LIB_PATH.DS.'pack_price.php');
require_once(LIB_PATH.DS.'contact.php');
require_once(LIB_PATH.DS.'photosignal.php');
require_once(LIB_PATH.DS.'photographic.php');
require_once(LIB_PATH.DS.'mailing_users.php');
require_once(LIB_PATH.DS.'investor.php');
require_once(LIB_PATH.DS.'investor_acc.php');

require_once(LIB_PATH.DS.'level_basic.php');
require_once(LIB_PATH.DS.'level_intermediate.php');
require_once(LIB_PATH.DS.'level_advanced.php');
require_once(LIB_PATH.DS.'level_skygital.php');
require_once(LIB_PATH.DS.'global_sales.php');
require_once(LIB_PATH.DS.'portfolio.php');
require_once(LIB_PATH.DS.'cert_affiliate.php');

require_once(LIB_PATH.DS.'assoc_project.php');
require_once(LIB_PATH.DS.'user_associate.php');
require_once(LIB_PATH.DS.'user_wompromo.php');
require_once(LIB_PATH.DS.'womowner_pay.php');
require_once(LIB_PATH.DS.'womowner_publish.php');
require_once(LIB_PATH.DS.'womowner_preferred.php');
require_once(LIB_PATH.DS.'prompt_publish.php');

require_once(LIB_PATH.DS.'list_bodycam.php');
require_once(LIB_PATH.DS.'list_mailing.php');
require_once(LIB_PATH.DS.'list_monetize.php');
require_once(LIB_PATH.DS.'list_dietary.php');
require_once(LIB_PATH.DS.'list_nutrition.php');
require_once(LIB_PATH.DS.'list_leilmall.php');
require_once(LIB_PATH.DS.'list_skygital.php');
require_once(LIB_PATH.DS.'list_skygital_wom.php');
require_once(LIB_PATH.DS.'list_seatreserve.php');
require_once(LIB_PATH.DS.'page_link.php');

?>
