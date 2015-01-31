<?php 
class CategoryController extends AppController{
	
	public function admin_index(){
		$this->set('title_for_layout', 'Category List');
	}

	/*Main Start*/
	public function admin_main(){
		$this->set('title_for_layout', 'Main-Category List');
	}

	public function admin_maincategorylist(){
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		$conditions = array('Category.category_status <>' => 2, "Category.parent_id" => 0);

		$count = $this->Category->find('count', array(
			'recursive' => -1,
			'conditions' => $conditions,
			)
		);

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

		$fields = array('Category.*', 'count(SubCategory.parent_id) as subcatcnt');
		
		//$conditions = array('Category.category_status <>' => 2, "Category.parent_id" => 0);

		$CategoryList = $this->Category->find(
			"all",
			array(
				'fields'=>$fields,
				'joins'=>array(
					array(
						'table' => 'booking_categories',
						'alias' => 'SubCategory',
						'type' => 'LEFT',
						'conditions' => array('Category.id = SubCategory.parent_id')
					)
				),
				'group' => array('Category.id', 'Category.parent_id'), //fields to GROUP BY
				'recursive' => 0,
				'conditions' => $conditions
			)
		); 

		/*$CategoryList = $this->Category->find('all', array(
			'conditions' => $conditions,
			'order' => $order_by,
			'limit' => $limit,
			'offset' => $start
			)
		);*/
		//prd($CategoryList);
		$temp = array();

		$responce = new stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;

		$i = 0;
		if (is_array($CategoryList))
		{
			$temp = array();
			foreach ($CategoryList as $key => $Categorypages): {

					$title = $Categorypages['Category']['category_name'];
					
					$servicecount = " ";
					if(isset($Categorypages['Category']['service_count']) && $Categorypages['Category']['service_count']!=0)
					{
						$servicecount = '<a href="'. $this->webroot . 'admin/services/index/' . $Categorypages['Category']['id'] .'/">('.$Categorypages['Category']['service_count'].')</a>';
					}
					

					$newservice = '<center><a href="services/add/'.$Categorypages['Category']['id'].'" style="margin:2px;" class="btn btn-primary ">Add Service</a></center>';

					$action = '';
					$status = '';
					$delete = '';
					
					if ($Categorypages['Category']['category_status'] == 1)
					{
						$status .= '<center><i class="fa fa-circle fa-lg clrDisable" onclick="changeCategoryStatus(' . $Categorypages['Category']['id'] . ',0)" title="Change Status"></i></center>';
					}
					else if ($Categorypages['Category']['category_status'] == 0)
					{
						$status .= '<center><i class="fa fa-circle fa-lg clrEmable" onclick="changeCategoryStatus(' . $Categorypages['Category']['id'] . ',1)" title="Change Status"></i></center>';
					}

					$action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/category/editmain/' . $Categorypages['Category']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';

					$delete .= '<center><i class="fa fa-trash fa-lg" onclick="categorydelete(' . $Categorypages['Category']['id'] . ')" title="Delete Content"></i></center>'; 
					
					if ($Categorypages[0]['subcatcnt']=="0") {
						$subcatcnt = '( 0 )';
					}else{
						$subcatcnt = $servicecount = '<a href="'. $this->webroot . 'admin/category/sub/' . $Categorypages['Category']['id'] .'/">( '.$Categorypages[0]['subcatcnt'].' )</a>';
					}
					
					$responce->rows[$i]['id'] = $Categorypages['Category']['id'];

					//$responce->rows[$i]['cell'] = array($i+1, $title, $servicecount, $newservice, $status, $action, $delete);
					$responce->rows[$i]['cell'] = array($i+1, $title, $subcatcnt, $status, $action, $delete);
					$i++;
				}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}

	public function admin_addmain(){

		$this->set('title_for_layout', 'Add New Category');

		if($this->request->is('post')){

			$this->request->data['Category']['category_created'] = date('Y-m-d H:i:s');
			$this->request->data['Category']['category_modified	'] = date('Y-m-d H:i:s');

			$this->loadModel('Category');
			
			if($this->Category->save($this->request->data)){

				$this->Session->setFlash(__('Your Category has been Added.'), 'flash_success');

          		return $this->redirect(array('controller' => 'category', 'action' => 'admin_main'));

			}
			$this->Session->setFlash(__('Unable to save your category.'), 'flash_error');
		}
	}
	
	public function admin_editmain($id = NULL){
		$this->set('title_for_layout', 'Edit Category');

		if (!$id) {
	        throw new NotFoundException(__('Invalid category'));
    	}

	    $category = $this->Category->findById($id);
	    if (!$category) {
	        throw new NotFoundException(__('Invalid category'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	    	$this->Category->id = $id;
			$this->request->data['Category']['category_modified'] = date('Y-m-d H:i:s', strtotime('now'));

	        if ($this->Category->save($this->request->data)){
	        	$this->Session->setFlash(__('Your Category has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'category', 'action' => 'admin_main'));
	        }
	        $this->Session->setFlash(__('Unable to update your category.'), 'flash_error');
	    }

	    if (!$this->request->data) {
	        $this->request->data = $category;
	    }
	}
	
	public function admin_deletemain($id = NULL){
		if($this->request->is('post')){
			$this->loadModel('Category');
			$data = $this->request->data;
			$this->Category->updateAll(
				array('category_status' => 2),
				array('id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	
	public function admin_changestatusmain(){
		if($this->request->is('post')){
			$this->loadModel('Category');
			$data = $this->request->data;
			$this->Category->updateAll(
				array('category_status' => $data['status']),
				array('id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	/*Main End*/

	/*Sub Start*/
	public function admin_sub($maincatid = NULL){
		$this->set('title_for_layout', 'Sub-Category List');
		$this->set('maincatid', $maincatid);
	}

	public function admin_subcategorylist($maincatid = NULL){
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		if (is_null($maincatid)) {
			$conditions = array("Category.category_status <>" => 2, "Category.parent_id <>" => 0);
		} else {
			$conditions = array("Category.category_status <>" => 2, "Category.parent_id <>" => 0, "Category.parent_id" => $maincatid);
		}
		
		$count = $this->Category->find('count', array(
			'recursive' => -1,
			'conditions' => $conditions,
			)
		);

		if ($count > 0){
			$total_pages = ceil($count / $limit);
		}else{
			$total_pages = 0;
		}

		if ($page > $total_pages){
			$page = $total_pages;
		}

		$start = $limit * $page - $limit;

		$CategoryList = $this->Category->find('all',
			array(
				'conditions' => $conditions,
				'order' => $order_by,
				'limit' => $limit,
				'offset' => $start
			)
		);
		//prd($CategoryList);
		$temp = array();

		$responce = new stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;

		$i = 0;

		if (is_array($CategoryList)){
			$temp = array();
			foreach ($CategoryList as $key => $Categorypages): {

					$title = $Categorypages['Category']['category_name'];
					
					$servicecount = " ";
					if(isset($Categorypages['Category']['service_count']) && $Categorypages['Category']['service_count']!=0){
						$servicecount = '<a href="'. $this->webroot . 'admin/services/index/' . $Categorypages['Category']['id'] .'/">('.$Categorypages['Category']['service_count'].')</a>';
					}
					
					$newservice = '<center><a href="services/add/'.$Categorypages['Category']['id'].'" style="margin:2px;" class="btn btn-primary ">Add Service</a></center>';
					
					$action = '';
					$status = '';
					$delete = '';
					
					if ($Categorypages['Category']['category_status'] == 1)
					{
						$status .= '<center><i class="fa fa-circle fa-lg clrDisable" onclick="changeCategoryStatus(' . $Categorypages['Category']['id'] . ',0)" title="Change Status"></i></center>';
					}
					else if ($Categorypages['Category']['category_status'] == 0)
					{
						$status .= '<center><i class="fa fa-circle fa-lg clrEmable" onclick="changeCategoryStatus(' . $Categorypages['Category']['id'] . ',1)" title="Change Status"></i></center>';
					}

					$action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/category/editsub/' . $Categorypages['Category']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';

					$delete .= '<center><i class="fa fa-trash fa-lg" onclick="categorydelete(' . $Categorypages['Category']['id'] . ')" title="Delete Content"></i></center>'; 
					
					$responce->rows[$i]['id'] = $Categorypages['Category']['id'];
					//$responce->rows[$i]['cell'] = array($i+1, $title, $servicecount, $newservice, $status, $action, $delete);
					$responce->rows[$i]['cell'] = array($i+1, $title, $status, $action, $delete);
					$i++;
				}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}

	public function admin_addsub(){

		$this->set('title_for_layout', 'Add New Category');

		$parent_category = $this->Category->find('all', array(
			'conditions' => array("parent_id" => "0") ,
			'order' => "category_name",
			'recursive' => 0
			)
		);
		
		$parent_id = $this->createlistarray($parent_category, "id", "category_name", "Select Main Category");

		$this->set("parent_id", $parent_id);

		if($this->request->is('post')){

			if($this->request->data['Category']['parent_id']=="0")
			{
				$this->Session->setFlash(__('Please select Main Category.'), 'flash_error');
			}
			else
			{
				$this->request->data['Category']['category_created'] = date('Y-m-d H:i:s');
				$this->request->data['Category']['category_modified	'] = date('Y-m-d H:i:s');

				$this->loadModel('Category');
				
				if($this->Category->save($this->request->data)){

					$this->Session->setFlash(__('Your Category has been Added.'), 'flash_success');

	          		return $this->redirect(array('controller' => 'category', 'action' => 'admin_sub'));

				}
				$this->Session->setFlash(__('Unable to save your category.'), 'flash_error');
			}
		}
	}
	
	public function admin_editsub($id = NULL){
		$this->set('title_for_layout', 'Edit Category');

		$parent_category = $this->Category->find('all', array(
			'conditions' => array("parent_id" => "0") ,
			'order' => "category_name",
			'recursive' => 0
			)
		);
		
		$parent_id = $this->createlistarray($parent_category, "id", "category_name", "Select Main Category");

		$this->set("parent_id", $parent_id);

		if (!$id) {
	        throw new NotFoundException(__('Invalid category'));
    	}

	    $category = $this->Category->findById($id);
	    if (!$category) {
	        throw new NotFoundException(__('Invalid category'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Category->id = $id;
					$this->request->data['Category']['category_modified'] = date('Y-m-d H:i:s', strtotime('now'));
	        if ($this->Category->save($this->request->data)) {
	            $this->Session->setFlash(__('Your Category has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'category', 'action' => 'admin_sub'));
	        }
	        $this->Session->setFlash(__('Unable to update your category.'), 'flash_error');
	    }

	    if (!$this->request->data) {
	        $this->request->data = $category;
	    }
	}
	
	public function admin_deletesub($id = NULL){
		if($this->request->is('post')){
			$this->loadModel('Category');
			$data = $this->request->data;
			$this->Category->updateAll(
				array('category_status' => 2),
				array('id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	
	public function admin_changestatussub(){
		if($this->request->is('post')){
			$this->loadModel('Category');
			$data = $this->request->data;
			$this->Category->updateAll(
				array('category_status' => $data['status']),
				array('id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	/*Sub End*/

	public function createlistarray($arr, $arrid, $arrvalue, $firstlbl){
		$returnarr = array(0=>$firstlbl);
		foreach($arr as $key => $value){
			foreach($value as $valuekey => $innervalue){
				$returnarr[$innervalue[$arrid]] = $innervalue[$arrvalue];
			}
		}
		return $returnarr;
	}
}