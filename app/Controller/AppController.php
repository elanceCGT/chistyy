<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('AuthComponent', 'Controller/Component');
App::uses('Sanitize', 'Utility');
App::import('Vendor', 'DateTimeUtil/DateTimeConverter');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

	public $components = array(
		'Auth',
		'Session',
		'Cookie',
		'RequestHandler',
		'Captcha'
	);
	public $helpers = array(
		'Html',
		'Form',
		'Js',
		'Session',
		'Text',
		'Time',
	);
	public $AdminListings = array();
	public $GlobalViewData = array();
	
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Session->write('lang', 'eng');
		
		// Global Var to access in Views & Elements
		$this->GlobalViewData = array(
			'Controller' => strtolower($this->request->param("controller")),
			'Action' => strtolower($this->request->param("action")),
			'UserID' => $this->_getCurrentUserId()
		);
		$this->set("GlobalViewData", $this->GlobalViewData);
		
		if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin')
		{
			$this->layout = 'admin';
			$this->Auth->loginAction = array('admin' => true, 'controller' => 'users', 'action' => 'login');
			$this->Auth->loginRedirect = array('admin' => true, 'controller' => 'index', 'action' => 'index');
			$this->Auth->logoutRedirect = array('admin' => true, 'controller' => 'users', 'action' => 'login');
			$this->AdminListings = array(array('controller' => 'index', 'action' => 'index', 'heading' => 'Dashboard'));
		}
		else
		{
			//echo "<h1 style='text-align:center'>Page under construction</h1>";exit;
			$this->layout = 'default';
			$this->Auth->loginAction = array('admin' => false, 'controller' => 'index', 'action' => 'index');
			$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'users', 'action' => 'index');
			$this->Auth->logoutRedirect = array('admin' => false, 'controller' => 'index', 'action' => 'index');
		}
		
		// Controller Level Authorization
		$this->Auth->authorize = array('Controller');
	}

	public function isAuthorized($user)
	{
		$user_type = $this->Auth->User("user_type");
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin')
		{	
			$access_allowed = array('0');
			if (!in_array($user_type, $access_allowed))
			{
				$this->redirect(array('controller' => 'index', 'action' => 'index', 'admin' => false));
				return false;
			}
		}
		else
		{
			$access_allowed = array('1', '2', '3');
			if (!in_array($user_type, $access_allowed))
			{
				$this->redirect(array('controller' => 'index', 'action' => 'admin_index', 'admin' => true));
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Get Current logged in user id
	 */
	protected function _getCurrentUserId()
	{
		if (isset($this->Auth)) {
			$user_id = $this->Auth->User("id");
		}
		else{
			$user_id = AuthComponent::User("id");
		}
		return $user_id;
	}

	/*
	 * function use for check user status and redirect to index 
	 */
	protected function __checkUserStatus($user = array())
	{
		if (isset($user['User']['id']))
		{
			if ($user['User']['status'] == 0)
			{ //Disabled
				$this->Session->setFlash(__('Your account is disabled.'), 'flash_error');
				$this->redirect(array('controller' => 'index', 'action' => 'index'));
			}
			if ($user['User']['status'] == 3)
			{
				$this->Session->setFlash(__('Your account activation is pending.'), 'flash_error');
				$this->redirect(array('controller' => 'index', 'action' => 'index'));
			}
			if ($user['User']['status'] == 2)
			{
				$this->Session->setFlash(__('Your account has been deleted.'), 'flash_error');
				$this->redirect(array('controller' => 'index', 'action' => 'index'));
			}
			return true;
		}
		return false;
	}

	public function createthumb($source_image, $destination_image_url, $get_width, $get_height)
	{
		ini_set('memory_limit', '512M');
		set_time_limit(0);

		$image_array = explode('/', $source_image);
		$image_name = $image_array[count($image_array) - 1];
		$max_width = $get_width;
		$max_height = $get_height;
		$quality = 100;

		//Set image ratio
		list($width, $height) = getimagesize($source_image);
		$ratio = ($width > $height) ? $max_width / $width : $max_height / $height;
		$ratiow = $width / $max_width;
		$ratioh = $height / $max_height;
		$ratio = ($ratiow > $ratioh) ? $max_width / $width : $max_height / $height;

		if ($width > $max_width || $height > $max_height)
		{
			$new_width = $width * $ratio;
			$new_height = $height * $ratio;
		}
		else
		{
			$new_width = $width;
			$new_height = $height;
		}

		if (preg_match("/.jpg/i", "$source_image") or preg_match("/.jpeg/i", "$source_image"))
		{
			//JPEG type thumbnail
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromjpeg($source_image);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagejpeg($image_p, $destination_image_url, $quality);
			imagedestroy($image_p);
		}
		elseif (preg_match("/.png/i", "$source_image"))
		{
			//PNG type thumbnail
			$im = imagecreatefrompng($source_image);
			$image_p = imagecreatetruecolor($new_width, $new_height);
			imagealphablending($image_p, false);
			imagecopyresampled($image_p, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagesavealpha($image_p, true);
			imagepng($image_p, $destination_image_url);
		}
		elseif (preg_match("/.gif/i", "$source_image"))
		{
			//GIF type thumbnail
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromgif($source_image);
			$bgc = imagecolorallocate($image_p, 255, 255, 255);
			imagefilledrectangle($image_p, 0, 0, $new_width, $new_height, $bgc);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagegif($image_p, $destination_image_url, $quality);
			imagedestroy($image_p);
		}
		else
		{
			echo 'unable to load image source';
			exit;
		}
	}

	public function cropImage($sFile, $dFile, $x, $y, $targ_w, $targ_h, $w, $h)
	{
		//$extension = array_pop(explode(".",$sFile));
		$extension = array_reverse(explode(".", $sFile));
		$extension = $extension[0];
		$jpeg_quality = 90;


		$image_p = imagecreatetruecolor($targ_w, $targ_h);

		$background = imagecolorallocate($image_p, 0, 0, 0);

		$newImage = imagecreatetruecolor($targ_w, $targ_h);

		$extension = strtolower($extension);
		if ($extension == "png")
		{
			$img_r = imagecreatefrompng($sFile);
		}
		elseif ($extension == "jpg" || $extension == "jpeg")
		{
			$img_r = imagecreatefromjpeg($sFile);
		}
		elseif ($extension == "gif")
		{
			$img_r = imagecreatefromgif($sFile);
		}

		imagecolortransparent($image_p, $background);
		imagealphablending($image_p, false);
		imagesavealpha($image_p, true);
		imagecopyresampled($image_p, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);

		if ($extension == "png" || $extension == "PNG")
		{

			imagepng($image_p, $dFile, 0);
		}
		elseif ($extension == "jpg" || $extension == "jpeg" || $extension == "JPG" || $extension == "JPEG")
		{

			imagejpeg($image_p, $dFile, 90);
		}
		elseif ($extension == "gif" || $extension == "GIF")
		{

			imagegif($image_p, $dFile);
		}
		chmod($dFile, 0777);
		//unlink($sFile);
	}

	public function adminContImage($ImageName = NULL, $alt = NULL)
	{
		if ($ImageName)
		{
			$alttxt = $alt;
			if ($alt == NULL)
			{
				$alttxt = '';
			}
			else
			{
				$alttxt = 'alt="' . $alt . '"';
			}
			return '<img src="' . $this->webroot . IMAGES_URL . 'admin/' . $ImageName . '" ' . $alttxt . ' border="0" />';
		}
	}
	
	/**
	 * return field name as per selected language.
	 * @param type $field
	 * @return string
	 */
	public function langField($field)
	{
		$lang = $this->Session->read('lang');
		$lang = (!empty($lang)) ? $lang : 'eng';
		$newField = $field;
		switch ($lang)
		{
			case 'jpn':
				$newField = $field.'_jpn';
				break;
			default :
				$newField = $field;
				break;
		}
		return $newField;
	}
	
	/**
	 * Upload / Move file to the given path
	 * @param file $file
	 * @param string $saveDir
	 * @param string $prefix
	 * @return string|boolean
	 */
	protected function _moveUploadFile($file, $saveDir, $prefix = 'File')
	{
		if ($file['error'] == 0)
		{
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$file_new_name = $prefix . '_' . uniqid() . '.' . $ext;

			$saveDir .= (substr($saveDir, -1) == '/' ? '' : '/');

			if (move_uploaded_file($file['tmp_name'], $saveDir . $file_new_name))
			{
				//chmod($saveDir . $file_new_name, 0755);
				return $file_new_name;
			}
		}
		return false;
	}
    
    
}
