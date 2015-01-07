<?php
/**
 * FaqCategories Controller
 * @author:	Jogendar singh
 * @created: 18-07-2014 
 */
 
App::uses('AppController', 'Controller');

class FaqCategoriesController extends AppController{

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('');
	}
	
	/**
	 * function use for Admin Faq Category list grid view(html).. 
	 * "jq Grid"
	*/
	
	public function admin_index(){
		$this->set('title_for_layout', 'FAQs Category List');
		array_push($this->AdminListings, array('controller'=>'FaqCategories','action'=>'admin_index','heading'=>'FAQs Category List'));
        $this->set('Listings',$this->AdminListings);
	}
	
	/**
	 * function use for Admin Faq Category list .. 
	 * jq grid"
	*/
	public function admin_faqcat_list(){
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];
		if (!$sidx)
			$sidx = 1;

		$order_by = $sidx . ' ' . $sord;
		$conditions = array();
		$conditions['FaqCategory.status !='] = 2;

		if (isset($this->request->query['filters'])){
			$filters = json_decode($this->request->query['filters'], true);
			foreach ($filters['rules'] as $each_filter){
				if ($each_filter['field'] == 'id'){
					$conditions['FaqCategory.id'] = Sanitize::clean($each_filter['data']);
				}
				if ($each_filter['field'] == 'title'){
					$conditions['FaqCategory.title LIKE'] = '%'.Sanitize::clean($each_filter['data']) . '%';
				}
				if ($each_filter['field'] == 'created'){
					$conditions['FaqCategory.created LIKE'] = '%'.Sanitize::clean($each_filter['data']) . '%';
				}
				if ($each_filter['field'] == 'updated'){
					$conditions['FaqCategory.updated LIKE'] ='%'. Sanitize::clean($each_filter['data']) . '%';
				}
			}
		}
		$count = $this->FaqCategory->find('count', 
						array(
							'recursive' => -1,
							'conditions' => $conditions
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

		$FaqCategoryList = $this->FaqCategory->find('all', array(
								'recursive' => -1, //int
								'conditions' => $conditions,
								'order' => $order_by,
								'limit' => $limit,
								'offset' => $start
							)
						);
		$responce =new stdClass();
		$responce->page = $page; 
		$responce->total = $total_pages; 
		$responce->records = $count;
		$i = 0;
		if (is_array($FaqCategoryList)){
			foreach ($FaqCategoryList as $faqcat_List){
				$title = $faqcat_List['FaqCategory']['title'];
				$title_jpn = $faqcat_List['FaqCategory']['title_jpn'];
				$id = $faqcat_List['FaqCategory']['id'];

				$created = date('m/d/Y',strtotime($faqcat_List['FaqCategory']['created']));
				$updated = date('m/d/Y',strtotime($faqcat_List['FaqCategory']['updated']));

				$edit = Router::url(array('controller' => 'FaqCategories', 'action' => 'edit', 'admin' => true, $id));
				$link_edit = '<a title="Edit Faq Category" class="grid_link space" href="' . $edit . '"><i class="fa fa-edit fa-lg"></i></a>';
				if($faqcat_List['FaqCategory']['status'] == 0){	
					$status = '<i class="fa fa-circle fa-lg clrDisable" onclick="changestatus(' . $id . ', 1)" title="Change Status"></i>';
				}
				else if($faqcat_List['FaqCategory']['status'] == 1){
					$status = '<i class="fa fa-circle fa-lg clrEmable" onclick="changestatus(' . $id . ', 0)" title="Change Status"></i>';
				}
				/*
				$status = '<a title="Enable User" href="javascript:void(0)" class="grid_link space" onclick="changestatus(' . $id . ', 1)">' . $this->adminContImage('status-red.png', 'Inactive') . '</a>';
				if ($faqcat_List['FaqCategory']['status'] == 1){
					$status = '<a  title="Disable User" href="javascript:void(0)" class="fa fa-circle fa-lg clrEmable" onclick="changestatus(' . $id . ', 0)">' . $this->adminContImage('status-green.png', 'Active') . '</a>';
				}*/
				$link_delete = '<a title="Delete" data-bb_' . $id . '="confirm" href="javascript:void(0)" class="grid_link space" onclick="deletecat(' . $id . ',2)" style="cursor:pointer;"><i title="Delete User" class="fa fa-times-circle fa-lg"></i></a>';
				$view = Router::url(array('controller' => 'Faqs', 'action' => 'index', 'admin' => true, $id));
				$manage_Faq ='<a title="Manage FAQ\'s content" class="grid_link " href="' . $view . '"><i class="fa fa-files-o"></i></a>';
				$action = $status . " " . $link_edit . " ". $link_delete;
				$responce->rows[$i]['id'] = $id;
				$responce->rows[$i]['cell'] = array($id, $title,$title_jpn /*,$created, $updated*/ ,$manage_Faq, $action);
				$i++;
			}
		}
		echo json_encode($responce);
		exit;
	}
	/**
	 * function use for Admin Add Faq Category details.. 
	*/
	public function admin_add(){

		$this->set('title_for_layout', 'Add FAQs Category Page');

		array_push($this->AdminListings, array('controller'=>'FaqCategories','action'=>'admin_add','heading'=>'Add FAQs Category Page'));
        $this->set('Listings',$this->AdminListings);

		if (($this->request->is("post")) || ($this->request->is("put"))){
			$data = $this->request->data;
			$this->FaqCategory->set($data);
			if ($this->FaqCategory->validates()){
				if ($this->FaqCategory->save($data)){
					$this->Session->setFlash('Faq Category Page Succefully Added.', 'default', array(), 'success');
					$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
				}else{
					$this->Session->setFlash('Some error occured while saving data.', 'default', array(), 'error');
					$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
				}
			}else{
				$this->Session->setFlash(__('Some error occured while saving data.'), 'default', array(), 'error');
				$this->request->data = $data;
			}
		}
	}
	/**
	 * function use for Admin Edit Faq Category details.. 
	 * Parameters -> $id = "Faq Category id "
	*/
	public function admin_edit($id = NULL){
		$this->set('title_for_layout', 'Edit FAQs Category Page');

		array_push($this->AdminListings, array('controller'=>'FaqCategories','action'=>'admin_edit','heading'=>'Edit FAQs Category Page'));
        $this->set('Listings',$this->AdminListings);

		$FaqCategoryData = $this->FaqCategory->findById($id);
		if (($this->request->is("post")) || ($this->request->is("put"))){
			$data = $this->request->data;
			
			$this->FaqCategory->id=$id;
			$this->FaqCategory->set($data);
			if ($this->FaqCategory->validates()){
				if ($this->FaqCategory->save($data)){
					$this->Session->setFlash('Faq Category Page Succefully Updated.', 'default', array(), 'success');
					$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
				}else{
					$this->Session->setFlash('Some error occured while saving data.', 'default', array(), 'error');
					$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
				}
			}else{
				$this->Session->setFlash(__('Some error occured while saving data.'), 'default', array(), 'error');
				$this->request->data = $data;
			}
		}else{
			$this->request->data = $FaqCategoryData;
		}
	}
	
	/**
	 * function use for Admin change Faq Category status.. 
	 * ajex action
	*/
	public function admin_changestatus(){
		$id = $this->request->data['catId'];
		if (!empty($id)){
			$this->FaqCategory->id = $id;
			$data = array();
			$data['status'] = $this->request->data['Status'];
			$res = $this->FaqCategory->save($data);
			echo "1";
		}else{
			echo "0";
		}
		exit;
	}

}