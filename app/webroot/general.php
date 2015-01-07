<?php
defined('SITE_NAME') || define('SITE_NAME', 'Chistyy');
defined('PATH_UPLOAD_PRODUCT_IMAGE') || define('PATH_UPLOAD_PRODUCT_IMAGE', WWW_ROOT.'files'.DS.'products'.DS);
defined('PATH_UPLOAD_PIN_IMAGE') || define('PATH_UPLOAD_PIN_IMAGE', WWW_ROOT.'files'.DS.'pins'.DS);
defined('PATH_UPLOAD_TEAM_IMAGE') || define('PATH_UPLOAD_TEAM_IMAGE', WWW_ROOT.'files'.DS.'our_team'.DS);
defined("PATH_UPLOAD_TEMP") || define("PATH_UPLOAD_TEMP", WWW_ROOT.'files'.DS."temp".DS);

function prd($d) {
    echo '<pre>'; print_r($d); echo '</pre>'; exit;
}


function langField($field){    
	$lang = (isset($_SESSION['lang'])) ? $_SESSION['lang'] : 'eng';
	$newField = $field;
	switch ($lang) {
            case 'jpn':
                $newField = $field . '_jpn';
		break;
            default :
                $newField = $field;
		break;
	}
	return $newField;
}
