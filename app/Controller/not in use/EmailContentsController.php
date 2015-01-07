<?php
App::uses('AppController', 'Controller');

class EmailContentsController extends AppController {

	public $name = 'EmailContents';
	
	public function admin_index(){
		$this->set('title_for_layout','Email Contents');

		array_push($this->AdminListings, array('controller'=>'email_contents','action'=>'index','heading'=>'Mail Templates'));

        $this->set('Listings',$this->AdminListings);
	}
	
	public function admin_edit($id=NULL){
        
        array_push($this->AdminListings, array('controller'=>'email_contents','action'=>'index','heading'=>'Mail Templates'));
		array_push($this->AdminListings, array('controller'=>'email_contents','action'=>'edit'.$id,'heading'=>'Update Email Content'));
		$this->set('Listings',$this->AdminListings);
        
        
        $EmailRow = $this->EmailContent->read(null,$id);
        //prd($EmailRow);
        
		if ( count($EmailRow) == 0  ) {
			$this->redirect(array('admin' => true, 'controller' => 'email_contents', 'action' => 'index'));
		}
		
        $request = $this->request;
		if (($request->is("post") || $request->is("put"))) {
			$data =$this->request->data ;
			$data['EmailContent']['modified'] = date("Y-m-d H:i:s");
			//prd($data);
            
            /* KEY WORD VALIDATION START */            
            $keywordsArr = explode(",",$data["EmailContent"]["keywords"] );
            //prd($keywordsArr);
            $kr = array();
            foreach($keywordsArr as $k => $v){
                $mystring = $data["EmailContent"]["content"];
                $findme   = $v;
                $pos = strpos($mystring,$findme); 
                if ($pos === false) {
                    //echo "The string '$findme' was not found in the string '$mystring'";
                    $kr[] = $v;
                }
            }
            if( count($kr) > 0){
                $this->Session->setFlash(__("Please use <strong>".implode(",",$kr).'</strong> keywords in body.'), 'flash_error');				
                $this->redirect(array('admin' => true, 'controller' => 'email_contents', 'action' => 'edit',$id));
            } 
            /* KEY WORD VALIDATION END*/
            
			if ($this->EmailContent->save($data)) {
				$this->Session->setFlash(__('Email content update successfully.'), 'flash_success');
				$this->redirect(array('admin' => true, 'controller' => 'email_contents', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('Email content could not be update.'), 'flash_error');
			}
        }else{
            $this->request->data = $EmailRow;
        }
		
		 
	}
	
	public function admin_emailgrid(){
		
		$page  = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx  = $this->request->query['sidx'];
		$sord  = $this->request->query['sord'];
		
		if(!$sidx) $sidx =1;
		$order_by = $sidx.' '.$sord;
		
		$conditions = array();
		
    	$count = $this->EmailContent->find('count',array(
				'recursive'  => -1,
			  	'conditions' => $conditions,
			)
		);
		
		if($count >0){ 
			$total_pages = ceil($count/$limit); 
		}else{
			$total_pages = 0; 
		}
		
		if ($page > $total_pages) {
			$page=$total_pages;
		}
			
		$start = $limit*$page - $limit; 
		
		$emailList = $this->EmailContent->find('all',array(
			  'conditions' =>$conditions,
				'order' => $order_by,
				'limit' => $limit,
				'offset' => $start
			)
		);
		
		$temp = array();
		
		$responce = new stdClass();
		$responce->page = $page; 
		$responce->total = $total_pages; 
		$responce->records = $count; 

		$i=0; 
		$j	=	(($page-1)*$limit)+1;
			
		if(is_array($emailList))
		{
			//prd($emailList);
			$temp = array();
			foreach($emailList as $emails):
			{
				
				$title 		 = $emails['EmailContent']['title'];
				$subject = strip_tags($emails['EmailContent']['subject']);
				$modified = $emails['EmailContent']['modified'];
				
				$action = '';
				
				if($emails['EmailContent']['status'] == 0){	
					$action .= '<i class="fa fa-circle fa-lg clrDisable" onclick="changeCmsStatus('.$emails['EmailContent']['id'].',0)" title="Change Status"></i>';
				}
				else if($emails['EmailContent']['status'] == 1){
					$action .= '<i class="fa fa-circle fa-lg clrEmable" onclick="changeCmsStatus('.$emails['EmailContent']['id'].',1)" title="Change Status"></i>';
				}
				
				$action .= '&nbsp;&nbsp;&nbsp;<a href="'.$this->webroot.'admin/email_contents/edit/'.$emails['EmailContent']['id'].'" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
        		$responce->rows[$i]['id']=$emails['EmailContent']['id'];
				$responce->rows[$i]['cell']=array($j,$title,$subject,$modified,$action); 
				$i++;$j++;
			}
			endforeach;
			
		}
		echo json_encode($responce); exit;
	}
	
	public function admin_changestatus(){
		
		if($this->request->is('ajax')){
			
			$data['EmailContent']['id'] = $this->request->data['id'];
			$data['EmailContent']['status'] = $this->request->data['status'] == 1 ? 0 : 1 ;
				
			if ($this->EmailContent->save($data)) {
				echo '1';
			} else {
				echo '0';
			}
			exit;
		}
		else{
			
		}
	}
	
	public function admin_mail()
	{
		$this->set('title_for_layout', 'Compose Mail');
		$this->loadModel('User');
		
		array_push($this->AdminListings, array('controller'=>'email_contents','action'=>'admin_mail','heading'=>'Compose Mail'));

		$this->set('Listings',$this->AdminListings);

		if ($this->request->is('post'))
		{

			$data = $this->request->data;
			if(isset($data['sendMail']) && $data['sendMail'] == 'Send Mail')
			{
				/**
				 * User Resuest from user list functionality.
				 */
				$userArr = explode(',',$data['user_ids']);
				
				$user_emails = $this->User->find('all',array(
					'recursive' => -1,
					'conditions' => array('id'=>$userArr),
					'fields' => array('email','first_name','last_name'),
				));
				
				$email = '';
				$names = '';
				foreach($user_emails as $emails){
					$email[]= $emails['User']['email'];
					if(!empty($emails['User']['first_name']))
					{
						$names[]= $emails['User']['first_name'] . " " . $emails['User']['last_name'];
					}
					else
					{
						$names[]=" ";	
					}
				}
				$this->set('user_email',implode(',',$email));
				$this->set('user_names',implode(',',$names));
			}
			else
			{
				/**
				 * Mail send post request.
				 */
				$userEmails = $data['EmailContent']['to'];
				$subject = $data['EmailContent']['subject'];
				$message = $data['EmailContent']['content'];

				$expression = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$/";
				$userEmails = explode(',', $userEmails);

				$temp = '';
				foreach ($userEmails as $email)
				{
					if (!preg_match($expression, $email))
					{
						$temp .= '<strong>' . $email . '</strong> , ';
					}
				}
				if (!empty($temp))
				{
					$this->Session->setFlash(__('Incorrect mail addresses : ' . $temp ), 'flash_error');
				} 
				else
				{
					//prd($data);
					$this->loadModel('EmailContent');

					if ($this->EmailContent->ComposeToManyMail($subject, $message, $userEmails))
					{
						$this->Session->setFlash(__('Mail successfully send.'), 'flash_success');
                        $this->redirect(array('admin' => true, 'controller' => 'email_contents', 'action' => 'mail'));
					} 
					else
					{
						$this->Session->setFlash(__('Mail cannot be sent. Please try again'), 'flash_error');
					}
				}
			}
		}
	}
	
	public function admin_ckupload(){
		
		$img = $_FILES['upload']['name'];
		$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		
		$imgName	=	uniqid().'.'.$ext;
		
		$url = PATH_UPLOAD_FILE.$imgName;
		
		if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) ){
		   $message = "No file uploaded.";
		}
		else if ($_FILES['upload']["size"] == 0){
		   $message = "The file is of zero length.";
		}
		else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png")
		AND ($_FILES['upload']["type"] != "video/x-flv")AND ($_FILES['upload']["type"] != "audio/mpeg")){
		  
		   $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
		}
		else if (!is_uploaded_file($_FILES['upload']["tmp_name"])){
		   $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
		}
		else {
		  $message = "";
		  $move = @ move_uploaded_file($_FILES['upload']['tmp_name'], $url);
		  if(!$move)
		  {
			  //prd($url);
			 $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.".$url."";
		  }
		  //$url = "../" . $url;
		}
		$funcNum = $_GET['CKEditorFuncNum'] ;
		$url =  $this->webroot.'files/uploads/'.$imgName;
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";	
		exit;
		
	}
	
}