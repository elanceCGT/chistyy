<?php
/**
 * Images Controller
 * @author:	Jogendar singh
 * @created: 18-07-2014 
 */
App::uses('AppController', 'Controller');

class ImagesController extends AppController
{

	//public $uses = array();

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('admin_uploadphoto','admin_save_profileimg');
	}
	
	/**
	 * function use for Admin Crop Images Popup(fancybox) .. 
	 * Parameters -> "userid,Imagename,flag(is_admin profile = 1 or user = '')"
	*/
	public function admin_profileimg($uid = NULL, $imageName = NULL,$flag=NULL)
	{
		$this->layout = 'admin_fancybox';
		$this->set('imageName', $imageName);
		$this->set('uid', $uid);
		$this->set('flag', $flag);
	}
	
	/**
	 * function use for Admin upload Original Images for Crop.. 
	 * "file_upload js"
	*/
	public function admin_uploadphoto()
	{
		//$data = $this->request->data;
		//prd($_FILES);
		//prd($this->Session->read('Auth'));
        
		$user_id = $this->Session->read('Auth.User.id');
        
		$file_name = "";

		if (isset($_FILES['uploadfile']['tmp_name']) and @ $_FILES['uploadfile']['tmp_name'] != ""){
			list($width, $height, $type, $attr) = getimagesize($_FILES['uploadfile']['tmp_name']);
			$explode = explode(".", $_FILES['uploadfile']['name']);
			$expNo = count($explode) - 1;
			$myExt = $explode[$expNo];

			$originalName = "Org_".$user_id.".". $myExt;

			$thumbName = "thumb_".$user_id.".".$myExt;

			$path = WWW_ROOT . "images/temp/";
			//echo $path;exit;
			$savePath = $path . $originalName;
			$savePathR = $path . $thumbName;
			@copy($_FILES['uploadfile']['tmp_name'], $savePath);
			$this->createthumb($savePath, $savePathR, 400, 300);
			unlink($savePath);
			$size = getimagesize($savePathR);
            
		}
		if (isset($originalName) && $originalName != ""){
			echo $thumbName . "|t=" . time() . "~~~" . $size[0] . "@@" . $size[1];
		}
		else{
			echo false;
		}
		exit;
	}
	
	/**
	 * function use for Admin save crop Images and save in database.
	 * Parameters -> "user_id"
	 * ajax Action
	*/
	public function admin_save_profileimg()
	{
		//echo "string";exit;
		$this->loadModel("User");

		$userid = $this->Session->read('Auth.User.id');
		//echo $userid;exit;
		$update_img = $this->User->findById($userid);

		$ajaxdata = $this->request->data;
		if ($ajaxdata["mycode"] != "")
		{
			$arr = explode("?", $ajaxdata["mycode"]);
			$mycode = $arr[0];
		}
		if ($mycode != ''){
			$extension2 = explode(".", $mycode);
			$extension = $extension2[1];
			$x = $ajaxdata["x"];
			$y = $ajaxdata["y"];
			$x2 = $ajaxdata["x2"];
			$y2 = $ajaxdata["y2"];
			$w = $ajaxdata["w"];
			$h = $ajaxdata["h"];

			$sPath = WWW_ROOT . "images/temp/";
			$dPath = WWW_ROOT . "images/user/big/";
			$dPath2 = WWW_ROOT ."images/user/small/";
			

			$sFileName = "thumb_".$userid.".".$extension;
			$dFileName = "user_".$userid.".".$extension;

			$sFile = $sPath.$sFileName;
			$dFile = $dPath.$dFileName;
			$dFile2 = $dPath2.$dFileName;

			$targ_w = $targ_h = 100;
			
			$this->cropImage($sFile, $dFile, $x, $y, $targ_w, $targ_h, $w, $h);
			$this->createthumb($dFile, $dFile2, 48, 48);

			 
			$this->User->updateAll(array('User.image' => "'" . $dFileName . "'"), array('User.id' => $userid));

			$this->Session->write('Auth.User.image',$dFileName) ; 
			echo $dFileName;
			exit;
		}
	}
    
    
    /**
	 * function use for Admin upload Original Images for Crop.. 
	 * "file_upload js"
	*/
	public function admin_uploadteam(){
		
        
		$user_id = rand()."_".time();
        //$user_id = "1_1";
        
		$file_name = "";

		if (isset($_FILES['uploadfile']['tmp_name']) and @ $_FILES['uploadfile']['tmp_name'] != ""){
			list($width, $height, $type, $attr) = getimagesize($_FILES['uploadfile']['tmp_name']);
			$explode = explode(".", $_FILES['uploadfile']['name']);
			$expNo = count($explode) - 1;
			$myExt = $explode[$expNo];

			$originalName = "Org_".$user_id.".". $myExt;

			$thumbName = "thumb_".$user_id.".".$myExt;

			$path = PATH_UPLOAD_TEAM_IMAGE . "temp/";
			
			$savePath   = $path.$originalName;
			$savePathR  = $path.$thumbName;
            
            //echo $savePath."==============".$savePathR; exit; 
            
			@copy($_FILES['uploadfile']['tmp_name'], $savePath);
			$this->createthumb($savePath, $savePathR, 400, 300);
			unlink($savePath);
			$size = getimagesize($savePathR);
            
		}
		if (isset($originalName) && $originalName != ""){
			echo $thumbName . "|t=" . time() . "~~~" . $size[0] . "@@" . $size[1];
		}
		else{
			echo false;
		}
		exit;
	}
    
    /**
	 * function use for Admin save crop Images and save in database.
	 * Parameters -> "user_id"
	 * ajax Action
	*/
	public function admin_save_our_team()
	{
		//echo "string";exit;
		$this->loadModel("User");

		
		$userid = "";

		$ajaxdata = $this->request->data;
		if ($ajaxdata["mycode"] != "")
		{
			$arr = explode("?", $ajaxdata["mycode"]);
			$mycode = $arr[0];
		}
		if ($mycode != ''){
			$userid = $mycode;
            $extension2 = explode(".", $mycode);
			$extension = $extension2[1];
			$x = $ajaxdata["x"];
			$y = $ajaxdata["y"];
			$x2 = $ajaxdata["x2"];
			$y2 = $ajaxdata["y2"];
			$w = $ajaxdata["w"];
			$h = $ajaxdata["h"];

            /*
			$sPath = WWW_ROOT."our_team/temp/";
			$dPath = WWW_ROOT."our_team/";
			*/
            $sPath = PATH_UPLOAD_TEAM_IMAGE ."temp/";
			$dPath = PATH_UPLOAD_TEAM_IMAGE;
            
			$sFileName = $userid;
			//$dFileName = "our_team_1.".$extension;
            $dFileName = $userid;

			$sFile = $sPath.$sFileName;
			$dFile = $dPath.$dFileName;
			//echo $sFile."----";
            //echo $dFile;exit;
			$targ_w = $targ_h = 170;
			
			$this->cropImage($sFile, $dFile, $x, $y, $targ_w, $targ_h, $w, $h);
			unlink($sFile);
            
			echo $dFileName;
			exit;
		}
	}
	
	 


}
