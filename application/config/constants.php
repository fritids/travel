<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('BASEURL',((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST']);
define('ASSETSPATH',BASEURL."/assets/");
define('IMAGEPATH',ASSETSPATH."images/");
define('JSPATH',ASSETSPATH."javascripts/");
define('CSSPATH',ASSETSPATH."stylesheets/");
define('OFFER_ATTACHMENT_PATH',ASSETSPATH."offers/");
define('HOTEL_ATTACHMENT_PATH',ASSETSPATH."profiles/");

define('OFFER_ATTACHMENT_FILE_PATH_FOR_AVATAR',"assets/offers/");
define('PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR',"assets/profiles/");
define('BILLS_ATTACHMENT_DOWNLOAD_PATH',"assets/bills/");

define('OFFER_ATTACHMENT_UPLOAD_PATH',$_SERVER['DOCUMENT_ROOT']."/assets/offers/");
define('PROFILE_ATTACHMENT_UPLOAD_PATH',$_SERVER['DOCUMENT_ROOT']."/assets/profiles/");


/* End of file constants.php */
/* Location: ./application/config/constants.php */