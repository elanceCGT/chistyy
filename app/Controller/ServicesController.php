<?php 
class ServicesController extends AppController{

	public function admin_index($cat=0){
		$this->set('cat', $cat);
		$this->set('title_for_layout', 'Service List');
	}
	
	public function admin_add(){

		$this->set('title_for_layout', 'Add Service');
		$this->loadModel('Category');
		$this->loadModel('Service');

		if($this->request->is('post')){
			
			$this->request->data['Service']['service_created'] = date('Y-m-d H:i:s');
			$this->request->data['Service']['service_modified'] = date('Y-m-d H:i:s');
			//prd($this->request->data);
			if($this->Service->save($this->request->data)){
	            $this->Session->setFlash(__('Your Service has been Added.'), 'flash_success');
	            return $this->redirect(array('controller' => 'services', 'action' => 'admin_index'));
	        }

        	$this->Session->setFlash(__('Unable to Add your Service.'), 'flash_error');
		}
		$category = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0,'Category.parent_id' => 0),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);
		//prd($category);
		$this->set('category', $category);
	}
	
	public function admin_subcatselectbox(){
		if($this->request->is('post')){
			$maincatid = $this->request->data['maincatid'];
			$this->loadModel('Category');
			$subcategory = $this->Category->find('list',
				array(
					'conditions' => array('Category.category_status' => 0,'Category.parent_id' => $maincatid),
					'fields' => array('Category.id', 'Category.category_name'),
					'order' => array('Category.category_name')
				)
			);
			//prd($subcategory);
			if(count($subcategory)>0){
				foreach ($subcategory as $key => $value) {
					echo '<option value="'.$key.'">'.$value.'</option>';
				}
			}else{
				echo '<option value=""></option>';
			}
			exit;
		}
		echo 0; exit;
	}

	public function admin_edit($id = NULL){
		
		$this->loadModel('Category');

		if (!$id) {
        	throw new NotFoundException(__('Invalid Service'));
        }

    	$Service = $this->Service->findById($id);

	    if (!$Service) {
	        throw new NotFoundException(__('Invalid Service'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        
	        $this->Service->id = $id;
			$this->request->data['Service']['service_modified'] = date('Y-m-d H:i:s', strtotime('now'));

	        if ($this->Service->save($this->request->data)) {
	            $this->Session->setFlash(__('Your Service has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'services', 'action' => 'admin_index'));
	        }

	        $this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
	    }

		$category = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => 0),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);
		$subcategory = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => $Service["Service"]["category_id"]),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);

		$this->set('category', $category);
		$this->set('subcategory', $subcategory);
		$this->set('title_for_layout', 'Edit Service');
	    if (!$this->request->data) {
	        $this->request->data = $Service;
	    }
	}
	
	public function admin_delete($id = NULL){
		if($this->request->is('post')){
			$this->loadModel('Service');
			$data = $this->request->data;
			$this->Service->updateAll(
				array('service_status' => 2),
				array('Service.id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	
	public function admin_changestatus(){
		if($this->request->is('post')){
			$this->loadModel('Service');
			$data = $this->request->data;
			$this->Service->updateAll(
				array('service_status' => $data['status']),
				array('Service.id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	
	public function admin_servicelist($cat=0){
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;
		if($cat!=0){
			$conditions = array('Service.service_status <> 2', 'Service.category_id = '.$cat);
		}else{
			$conditions = array('Service.service_status <> 2');
		}

		$count = $this->Service->find('count', array(
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

		//$ServiceList = $this->Service->find('all', array('conditions' => $conditions, 'order'=> $order_by, 'limit' => $limit, 'offset' => $start));
		$ServiceList = $this->Service->find(
			'all',
			array(
				'fields' => array('Service.*', 'Category.*', 'SubCategory.*'),
				'joins'=>array(
					array(
						'table' => 'booking_categories',
						'alias' => 'SubCategory',
						'type' => 'LEFT',
						'conditions' => array('Service.sub_category_id = SubCategory.id')
					)
				),
				'conditions' => $conditions,
				'order'=> $order_by,
				'limit' => $limit,
				'offset' => $start
			)
		);

		//prd($ServiceList);
		$temp = array();

		$responce = new stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;

		$i = 0;
		if (is_array($ServiceList)){
			$temp = array();
			foreach ($ServiceList as $key => $Servicepages): {

				$Service = $Servicepages['Service']['service_name'];
				$category = $Servicepages['Category']['category_name'];
				$subcategory = $Servicepages['SubCategory']['category_name'];
				
				$action = '';
				$status = '';
				$delete = '';
				
				if ($Servicepages['Service']['service_status'] == 1){
					$status .= '<center><i class="fa fa-circle fa-lg clrDisable" onclick="changeServiceStatus(' . $Servicepages['Service']['id'] . ',0)" title="Change Status"></i></center>';
				}else if ($Servicepages['Service']['service_status'] == 0){
					$status .= '<center><i class="fa fa-circle fa-lg clrEmable" onclick="changeServiceStatus(' . $Servicepages['Service']['id'] . ',1)" title="Change Status"></i></center>';
				}
				$action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/services/edit/' . $Servicepages['Service']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';

				$delete .= '<center><i class="fa fa-trash fa-lg" onclick="servicedelete(' . $Servicepages['Service']['id'] . ')" title="Delete Content"></i></center>';
				
				$responce->rows[$i]['id'] = $Servicepages['Service']['id'];
				$responce->rows[$i]['cell'] = array($i+1, $Service, $category, $subcategory, $status, $action, $delete);
				$i++;
			}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}
	
}
