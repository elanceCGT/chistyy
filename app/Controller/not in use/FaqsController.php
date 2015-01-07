<?php
/**
 * Faq Controller
 * @author:	Jogendar singh
 * @created: 18-07-2014 
 */

App::uses('AppController', 'Controller');

class FaqsController extends AppController{

	public function beforeFilter(){	parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	/**
	 * function use for Admin Faq list grid view(html).. 
	 * Parameters -> $id = "FaqCategory id"
	 * "jq Grid"
	*/
	public function admin_index($id = NULL){
		$this->set('title_for_layout', 'FAQs List');

		array_push($this->AdminListings, array('controller'=>'Faqs','action'=>'admin_index/'.$id,'heading'=>'FAQs List'));
        $this->set('Listings',$this->AdminListings);

		$this->loadModel('FaqCategory');
		if(!empty($id)){
			$title = $this->FaqCategory->find('first',array('conditions'=>array('FaqCategory.id'=>$id,'FaqCategory.status'=>1)));
			if(!empty($title)){
				$this->set('title',$title['FaqCategory']['title']);
			}else{
				$this->Session->setFlash('Invalid Category id.', 'default', array(), 'error');
				$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
			}
		}else{
			$this->Session->setFlash('Invalid Category id.', 'default', array(), 'error');
			$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
		}
		$this->set('cat_id', $id);
		
	}
	
	/**
	 * function use for Admin Faq list grid listing action.. 
	 * Parameters -> $cat_id = "FaqCategory id"
	 * "jq Grid"
	*/
	public function admin_faq_list($cat_id = NULL){
		$page	= $this->request->query['page'];
		$limit	= $this->request->query['rows'];
		$sidx	= $this->request->query['sidx'];
		$sord	 = $this->request->query['sord'];
		if (!$sidx)
			$sidx = 1;

		$order_by = $sidx . ' ' . $sord;
		$conditions = array();
		$conditions['Faq.status !='] = 2;
		$conditions['Faq.faq_category_id'] = $cat_id;
		
		if (isset($this->request->query['filters'])){
			$filters = json_decode($this->request->query['filters'], true);
			foreach ($filters['rules'] as $each_filter){
				if ($each_filter['field'] == 'id'){
					$conditions['Faq.id'] = Sanitize::clean($each_filter['data']);
				}

				if ($each_filter['field'] == 'Faq.title'){
					$conditions['Faq.title LIKE'] ='%'.Sanitize::clean($each_filter['data']) . '%';
				}
				if ($each_filter['field'] == 'Faq.created'){
					$conditions['Faq.created LIKE'] ='%'.Sanitize::clean($each_filter['data']) . '%';
				}
				if ($each_filter['field'] == 'Faq.updated'){
					$conditions['Faq.updated LIKE'] ='%'.Sanitize::clean($each_filter['data']) . '%';
				}
			}
		}
		$count = $this->Faq->find('count', array(
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

		$FaqList = $this->Faq->find('all', array(
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
		if (is_array($FaqList)){
			foreach ($FaqList as $faq_List){
				$title = $faq_List['Faq']['title'];
				$title_jpn = $faq_List['Faq']['title_jpn'];
				$id = $faq_List['Faq']['id'];
				$cat_id = $faq_List['Faq']['faq_category_id'];
				$created =date('m/d/Y',strtotime($faq_List['Faq']['created']));
				$updated = date('m/d/Y',strtotime($faq_List['Faq']['updated']));

				$edit = Router::url(array('controller' => 'Faqs', 'action' => 'edit', 'admin' => true, $id, $cat_id));
				$link_edit = '<a title="Edit Faq Category" class="grid_link space" href="' . $edit . '"><i class="fa fa-edit fa-lg"></i></a>';
				$status = '<i class="fa fa-circle fa-lg clrDisable" onclick="changestatus(' . $id . ', 1)" title="Change Status"></i>';
				if ($faq_List['Faq']['status'] == 1){
					$status = '<i class="fa fa-circle fa-lg clrEmable" onclick="changestatus(' . $id . ', 0)" title="Change Status"></i>';
				}
				$link_delete = '<a title="Delete" data-bb_' . $id . '="confirm" href="javascript:void(0)" class="grid_link space" onclick="deletecat(' . $id . ',2)" style="cursor:pointer;"><i title="Delete User" class="fa fa-times-circle fa-lg"></i></a>';
				$action = $status . " " . $link_edit . " " . $link_delete;
				$responce->rows[$i]['id'] = $id;
				$responce->rows[$i]['cell'] = array($i+1, $title, $title_jpn, /*$created, $updated,*/ $action);
				$i++; 
			}
		}
		echo json_encode($responce);
		exit;
	}
	
	/**
	 * function use for Admin Add Faq details.. 
	 * Parameters -> $cat_id = "Faq Category id"
	*/

	public function admin_add($cat_id =NULL){
		array_push($this->AdminListings, array('controller'=>'Faqs','action'=>'admin_add/'.$cat_id ,'heading'=>'Add FAQs Page'));
        $this->set('Listings',$this->AdminListings);

		if(empty($cat_id)){
			$this->Session->setFlash('Invalid Category id.', 'default', array(), 'error');
			$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
		}
		$this->set('title_for_layout', 'Add FAQs Page');
		$this->set('cat_id', $cat_id);
		if (($this->request->is("post")) || ($this->request->is("put"))){
			$this->request->data['Faq']['faq_category_id'] =$cat_id;
			$data = $this->request->data;
			$this->Faq->set($data);
			if ($this->Faq->validates()){
				if ($this->Faq->save($data)){
					$this->Session->setFlash('Faq Page Succefully Added.', 'default', array(), 'success');
					$this->redirect(array('admin' => true, 'controller' => 'Faqs', 'action' => 'index',$cat_id));
				}else{
					$this->Session->setFlash('Some error occured while saving data.', 'default', array(), 'error');
					$this->redirect(array('admin' => true, 'controller' => 'Faqs', 'action' => 'index',$cat_id));
				}
			}else{
				$this->Session->setFlash(__('Some error occured while saving data.'), 'default', array(), 'error');
				$this->request->data = $data;
			}
		}
	}
	
	/**
	 * function use for Admin Edit Faq details.. 
	 * Parameters -> $cat_id = "Faq Category "
	*/
	public function admin_edit($id = NULL, $cat_id = NULL){

		array_push($this->AdminListings, array('controller'=>'Faqs','action'=>'admin_edit/'.$id.'/'.$cat_id ,'heading'=>'FAQ Edit'));
        $this->set('Listings',$this->AdminListings);

		if(empty($cat_id) || empty($id)){
			$this->Session->setFlash('Invalid Category id.', 'default', array(), 'error');
			$this->redirect(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index'));
		}
		$this->set('title_for_layout', 'Edit FAQs Page');
		$this->set('cat_id', $cat_id);
		$FaqData = $this->Faq->findById($id);
		if (($this->request->is("post")) || ($this->request->is("put"))){
			$data = $this->request->data;

			$this->Faq->id = $id;

			$this->Faq->set($data);
			if ($this->Faq->validates()){
				if ($this->Faq->save($data)){
					$this->Session->setFlash('Faq Page Succefully Updated.', 'default', array(), 'success');
					$this->redirect(array('admin' => true, 'controller' => 'Faqs', 'action' => 'index', $cat_id));
				}else{
					$this->Session->setFlash('Some error occured while saving data.', 'default', array(), 'error');
					$this->redirect(array('admin' => true, 'controller' => 'Faqs', 'action' => 'index', $cat_id));
				}
			}else{
				$this->Session->setFlash(__('Some error occured while saving data.'), 'default', array(), 'error');
				$this->request->data = $data;
			}
		}else{
			$this->request->data = $FaqData;
		}
	}
	
	/**
	 * function use for Admin change Faq status.. 
	 * ajex action
	*/
	public function admin_changestatus(){
		$id = $this->request->data['Id'];
		if (!empty($id)){
			$this->Faq->id = $id;
			$data = array();
			$data['status'] = $this->request->data['Status'];
			$res = $this->Faq->save($data);
			echo "1";
		}else{
			echo "0";
		}
		exit;
	}

	public function index() {	
		$this->loadModel("FaqCategory");	
		$FaqList = $this->FaqCategory->find('all', array(
				'recursive' => 1, //int
				//'conditions' => $conditions,
				//'order' => $order_by,
				//'limit' => $limit,
				//'offset' => $start
			)
		);
		//prd($FaqList);
		$this->set( "FaqList" ,$FaqList);
	}
}
