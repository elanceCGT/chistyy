<?php
App::uses('AppController', 'Controller');
class TeamMembersController extends AppController
{

	public $components = array(
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email', 'password' => 'password'),
				)
			)
		)
	);

	public function beforeFilter()
	{
		parent::beforeFilter();
		$allowArr = array("admin_forgot", "admin_login", 'signup', 'login', 'logout');
		$this->Auth->allow($allowArr);
	}
	

	public function admin_memberadd(){

		$this->set('title_for_layout', 'Add Member');
        
		array_push($this->AdminListings, array('controller' => 'team_members', 'action' => 'admin_index', 'heading' => 'Team Member List'));
        
        array_push($this->AdminListings, array('controller' => 'team_members', 'action' => 'admin_memberadd', 'heading' => 'Add Member'));

		$this->set('Listings', $this->AdminListings);

		$request = $this->request;

		$errors = array();

		if (  ($request->is('post') || $request->is('put')) ){

			$data = $request['data'];
            $image = $data["TeamMember"]["image"];            
            unset($data["TeamMember"]["image"]);
			
			$this->TeamMember->set($data);

			if ($this->TeamMember->validates()){	
                
                $res = $this->TeamMember->save($data);
                if ($res){
                    if( $image != ""){
                        
                       $explode = explode(".", $image);
                       $expNo = count($explode) - 1;
                       $myExt = $explode[$expNo]; 
                        
                       //$basePath = WWW_ROOT."our_team/";
                       $basePath = PATH_UPLOAD_TEAM_IMAGE;
                       $source = $basePath.$image; 
                       
                       $dFile = "our_team_".$res["TeamMember"]["id"].".".$myExt;
                       
                       $destination = $basePath.$dFile;
                       if(file_exists($destination)){
                           unlink($destination);
                       }
                       copy($source ,$destination ) ;
                       unlink($source);
                       $this->TeamMember->id = $res["TeamMember"]["id"];
                       
                       $this->TeamMember->save(  array( "TeamMember" => array("image" => $dFile) )   );
                       ///prd($res["TeamMember"]["id"]);
                    }
                    
					$this->Session->setFlash(__("Member added successfully."), 'flash_success');
					$this->redirect(array('admin' => true, 'controller' => 'team_members', 'action' => 'admin_index' ));
				}
			}
			else{
				$errors = $this->TeamMember->validationErrors;            
			}
		}
		$this->set("errors", $errors);
	}

	public function admin_memberedit($currUserId = NULL){
            
        $this->loadModel("TeamMember");
		
        //$this->set('title_for_layout', 'Edit Member');
        array_push($this->AdminListings, array('controller' => 'team_members', 'action' => 'admin_index', 'heading' => 'Team Member List'));
		array_push($this->AdminListings, array('controller' => 'team_members', 'action' => 'admin_memberedit/'.$currUserId, 'heading' => 'Edit Member'));
		
        
        
        $this->set('Listings', $this->AdminListings);
        		
		$currUserRecord = $this->TeamMember->findById($currUserId);
        //prd($currUserRecord);
        
		if (!is_numeric($currUserId) or ( $currUserRecord == NULL)){
			$this->redirect( array('admin' => true, 'controller' => 'TeamMembers', 'action' => 'index') );
		}
		
		$request = $this->request;
		$errors = array();
		if (($request->is('post') || $request->is('put') )){

			$data = $request['data'];
			$data['TeamMember']['id'] = $currUserId;
            
            $image = (isset($data["TeamMember"]["image"]) && ($data["TeamMember"]["image"] != ""))  ? $data["TeamMember"]["image"] : "" ;            
            unset($data["TeamMember"]["image"]);
			$this->TeamMember->set($data);

			if ($this->TeamMember->validates()){	
                
                $res = $this->TeamMember->save($data);
                
				if ($res){					
                    if( ($image != "") && ($currUserRecord["TeamMember"]["image"] !=  $image) ){                        
                       $explode = explode(".", $image);
                       $expNo = count($explode) - 1;
                       $myExt = $explode[$expNo]; 
                        
                       //$basePath = WWW_ROOT."our_team/";
                       $basePath = PATH_UPLOAD_TEAM_IMAGE;
                       $source = $basePath.$image; 
                       
                       $dFile = "our_team_".$res["TeamMember"]["id"].".".$myExt;
                       
                       $destination = $basePath.$dFile;     
                       if(file_exists($destination)){
                           unlink($destination);
                       }
                       //echo $source."<br>" ;
                       //echo $destination ;exit;
                       copy($source ,$destination ) ;
                       unlink($source);
                       
                       $this->TeamMember->id = $res["TeamMember"]["id"];
                       
                       $this->TeamMember->save(  array( "TeamMember" => array("image" => $dFile) )   );
                       ///prd($res["TeamMember"]["id"]);
                    }
                    
                    $this->Session->setFlash(__("Member updated successfully."), 'flash_success');
					$this->redirect(array('admin' => true, 'controller' => 'team_members', 'action' => 'index'));
				}
			}
			else
			{
				$errors = $this->User->validationErrors;
			}
		}
		else
		{
			$this->request->data = $currUserRecord;
		}
		$this->set("errors", $errors);
	}

	public function admin_index()
	{
		$this->set('title_for_layout', 'Team Member List');
		array_push($this->AdminListings, array('controller' => 'team_members', 'action' => 'admin_index', 'heading' => 'Team Member List'));
        
        
		$this->set('Listings', $this->AdminListings);
	}

	public function admin_membergrid()
	{
        $this->loadModel("TeamMembers");
		$request = $this->request;
		$this->autoRender = false;
		$this->layout = 'ajax';

		if ($request->is('ajax'))
		{
			$page = $request->data('page');
			$limit = $request->data('rows');
			$order = $request->data('sord');
			$index = $request->data('sidx');
			$search = $request->data('_search');
			$start = ($page - 1) * $limit;

			$conditions = array();
			

			if (isset($search) && $search == true)
			{
				$name = $request->data('name');
				if (isset($name))
				{
					$conditions['TeamMembers.name LIKE'] = "%$name%";
				}

				$name_jpn = $request->data('name_jpn');
				if (isset($name_jpn))
				{
					$conditions['TeamMembers.name_jpn like'] = "%$name_jpn%";
				}

				$designation = $request->data('designation');
				if (isset($designation))
				{
					$conditions['TeamMembers.designation LIKE'] = "%$designation%";
				}
                $designation_jpn = $request->data('designation_jpn');
				if (isset($designation))
				{
					$conditions['TeamMembers.designation_jpn LIKE'] = "%$designation_jpn%";
				}
			}

			$joins = array(
			);


			$count = $this->TeamMembers->find('count', array(
				'conditions' => $conditions,
				'joins' => $joins,
				)
			);

			$total_records = $count;

			if ($total_records > 0)
			{
				$total_pages = ceil($total_records / $limit);
			}
			else
			{
				$total_pages = 0;
			}
			if ($page > $total_pages)
			{
				$page = $total_pages;
			}

			if (isset($index) && !empty($index))
			{
				$sort = array(" TeamMembers.$index $order ");

				if ($index == 'name')
				{
					$sort = array(" TeamMembers.name $order");
				}

				if ($index == 'name_jpn')
				{
					$sort = array(" TeamMembers.name_jpn $order");
				}

				if ($index == 'designation')
				{
					$sort = array(" TeamMembers.designation $order");
				}
                if ($index == 'designation_jpn')
				{
					$sort = array(" TeamMembers.designation_jpn $order");
				}
			}
			else
			{
				$sort = array(" name asc ");
			}

			if ($count > 0)
			{
				$total_pages = ceil($count / $limit);
			}
			else
			{
				$total_pages = 0;
			}

			if ($page > $total_pages)
			{
				$page = $total_pages;
			}

			$start = $limit * $page - $limit;

			$usersList = $this->TeamMembers->find('all', array(
				'conditions' => $conditions,
				'order' => $sort,
				'limit' => $limit,
				'offset' => $start,
				'joins' => $joins,
				//'fields' 	=> array('User.*','floor(datediff(curdate(),User.dob) / 365) as age','Country.*','Plan.*')
				'fields' => array('TeamMembers.*')
				)
			);


			$return_result['page'] = $page;
			$return_result['total'] = $total_pages;
			$return_result['records'] = $total_records;
			$i = 0;
            
			if (is_array($usersList)){
				$temp = array();
				foreach ($usersList as $user){
					$return_result['rows'][$i]['id'] = $user['TeamMembers']['id'];
					$return_result['rows'][$i]['cell'] = $user['TeamMembers'];
					$i++;
				}
			}
			echo json_encode($return_result);
			exit;
		}
		else
		{
			$this->render('/nodirecturl');
		}
	}

    public function admin_deleteUser(){
		if ($this->request->is('ajax')){			
			if (isset($this->request->data['id'])){	
				$this->TeamMember->delete($this->request->data['id']);
			}
			if (  isset($this->request->data['ids'])  ){
				$this->request->data['ids'];
				$cnd = array(
					"TeamMember.id" => explode(",", $this->request->data['ids'])
				);
				$this->TeamMember->deleteAll( $cnd );
			}
			exit;
		}
		else{
			$this->Session->setFlash(__('Invalid request'), 'flash_error');
			$this->redirect(array('admin' => true, 'controller' => 'Subscription', 'action' => 'index'));
		}
	}    
	
	public function GetConditionjqgrid($fld, $foper, $fldata)
	{

		/* $conditions = "";
		  $parent_field = '';
		  if( $fld == "parent_category_id"){
		  $fld = "Category.category_name";
		  $parent_field = 'parent_category_id';
		  }else{
		  $fld = "Category.".$fld;
		  } */

		switch ($foper) {
			case 'eq'://"is equal to" 
				$conditions = $fld . ' = "' . $fldata . '"';
				break;
			case 'ne': //"is not equal to"
				$conditions = $fld . ' != "' . $fldata . '"';
				break;
			case 'lt': //"is less than" 
				$conditions = $fld . ' < "' . $fldata . '"';
				break;
			case 'le': //"is less or equal to" 
				$conditions = $fld . ' <= "' . $fldata . '"';
				break;
			case 'gt': //"is greater than" 
				$conditions = $fld . ' > "' . $fldata . '"';
				break;
			case 'ge': //"is greater or equal to"
				$conditions = $fld . ' >= "' . $fldata . '"';
				break;
			case 'in': //"is in"
				$fieldArr = explode(",", $fldata);
				$fieldString = "";
				if (count($fieldArr) > 0)
				{
					$i = 0;
					foreach ($fieldArr as $key => $val)
					{
						$val = trim($val);
						if ($i != 0)
						{
							$fieldString .= ",";
						}
						$fieldString .= "'" . $val . "'";
						$i++;
					}
				}
				$conditions = '' . $fld . ' IN (' . $fieldString . ')';
				break;
			case 'ni': //"is not in" 
				$fieldArr = explode(",", $fldata);
				$fieldString = "";
				if (count($fieldArr) > 0)
				{
					$i = 0;
					foreach ($fieldArr as $key => $val)
					{
						$val = trim($val);
						if ($i != 0)
						{
							$fieldString .= ",";
						}
						$fieldString .= "'" . $val . "'";
						$i++;
					}
				}
				$conditions = '' . $fld . ' NOT IN (' . $fieldString . ')';
				break;
			case 'bw': //"begins with" 
				$conditions = $fld . ' LIKE "' . $fldata . '%"';
				break;
			case 'bn': //"does not begin with" 
				$conditions = $fld . ' NOT LIKE "' . $fldata . '%"';
				break;
			case 'ew': //"ends with" 
				$conditions = $fld . ' LIKE "%' . $fldata . '"';
				break;
			case 'en': //"does not end with" 
				$conditions = $fld . ' NOT LIKE "%' . $fldata . '"';
				break;
			case 'cn': //"contains" 
				$conditions = $fld . ' LIKE "%' . $fldata . '%"';
				break;
			case 'nc': //"does not contain" 
				$conditions = $fld . ' NOT LIKE "%' . $fldata . '%"';
				break;

			case 'nu': //"is null" 
				$conditions = '' . $fld . ' = ""';
				break;
			case 'nn': //"is not null" 
				$conditions = '' . $fld . ' != ""';
				break;
		}

		/* 	if(!empty($parent_field)){			
		  $conditions = " Category.parent_category_id in (select id from ez_categories as Category where ".$conditions.") ";
		  }
		 */
		//echo $conditions;exit;

		return $conditions;
	}
}
