<?php

App::uses('AppController', 'Controller');

class CmsPagesController extends AppController
{

	//public $name = 'CmsPage';

	public function beforeFilter()
	{
		parent::beforeFilter();
		$allow = array('get_content', 'index');
		$this->Auth->allow($allow);
	}

	public function admin_index()
	{
		$this->set('title_for_layout', 'CMS Page(s)');

		array_push($this->AdminListings, array('controller' => 'cms_pages', 'action' => 'admin_index', 'heading' => 'Cms Pages'));

		$this->set('Listings', $this->AdminListings);
	}

	public function admin_add()
	{
		$this->set('title_for_layout', 'Add Cms Pages');
		$this->loadModel('CmsPage');

		$CmspageRow = $this->CmsPage->find('list', array('conditions' => array('CmsPage.id != 0'), 'fields' => array('CmsPage.id',
				'CmsPage.title')));

		if (count($CmspageRow) > 0)
		{
			$this->set('CmspageList', $CmspageRow);
		}

		if ($this->request->is('post'))
		{

			$data = $this->request->data;

			$data['CmsPage']['created'] = date("Y-m-d H:i:s");
			$data['CmsPage']['updated'] = date("Y-m-d H:i:s");

			if ($this->CmsPage->save($data))
			{
				$this->Session->setFlash(__('Cms content added successfully.'), 'flash_success');
				//$this->siteMessage("CMS_CONTENT_SAVE_SUCCESS");
				$this->redirect(array('action' => 'admin_index'));
			}
			else
			{
				$this->Session->setFlash(__('Cms content can not be added.'), 'flash_error');
				//$this->siteMessage("CMS_CONTENT_SAVE_ERROR");
				$this->redirect(array('action' => 'admin_index'));
			}
		}
	}

	public function admin_edit($id = NULL)
	{
		$this->set('title_for_layout', 'Update Cms Page');
		
        array_push($this->AdminListings, array('controller' => 'cms_pages', 'action' => 'admin_index' , 'heading' => 'Cms Page'));
        
        array_push($this->AdminListings, array('controller' => 'cms_pages', 'action' => 'admin_edit/' . $id, 'heading' => 'Update Cms Page'));
        
		$this->set('Listings', $this->AdminListings);

		if (!is_numeric($id) or ( $id == NULL))
		{
			$this->redirect(array('admin' => true, 'controller' => 'CmsPages', 'action' => 'index'));
		}

		$request = $this->request;
		if (($request->isPost() || $request->isPut()))
		{
			$data = $this->request->data;
			$data['CmsPage']['updated'] = date("Y-m-d H:i:s");
			//prd($data);
			if ($this->CmsPage->save($data))
			{
				$this->Session->setFlash(__('Cms content update successfully.'), 'flash_success');
				$this->redirect(array('admin' => true, 'controller' => 'CmsPages', 'action' => 'index'));
			}
			else
			{
				//$this->Session->setFlash(__('Cms content could not be update.'), 'flash_error');
			}
		}
		else
		{
			$CmsRow = $this->CmsPage->read(null, $id);

			if (count($CmsRow) > 0)
			{
				$this->request->data = $CmsRow;
			}
		}
	}

	public function admin_cmslistgrid()
	{

		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		$conditions = array('CmsPage.status <> 2');

		$count = $this->CmsPage->find('count', array(
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

		$CmspageList = $this->CmsPage->find('all', array(
			'conditions' => $conditions,
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

		$i = 0;
		if (is_array($CmspageList))
		{
			$temp = array();
			foreach ($CmspageList as $Cmspages): {

					$title = $Cmspages['CmsPage']['title'];
					$description = strip_tags($Cmspages['CmsPage']['description']);
					//$description = $Cmspages['CmsPage']['description'];

					$action = '';

					if ($Cmspages['CmsPage']['status'] == 0)
					{
						$action .= '<i class="fa fa-circle fa-lg clrDisable" onclick="changeCmsStatus(' . $Cmspages['CmsPage']['id'] . ',0)" title="Change Status"></i>';
					}
					else if ($Cmspages['CmsPage']['status'] == 1)
					{
						$action .= '<i class="fa fa-circle fa-lg clrEmable" onclick="changeCmsStatus(' . $Cmspages['CmsPage']['id'] . ',1)" title="Change Status"></i>';
					}

					$action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/cms_pages/edit/' . $Cmspages['CmsPage']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';

					//$action .= '&nbsp;&nbsp;&nbsp;<i class="fa fa-trash fa-lg" onclick="deleteCmspage(' . $Cmspages['CmsPage']['id'] . ')" title="Delete"></i>';

					$responce->rows[$i]['id'] = $Cmspages['CmsPage']['id'];
					$responce->rows[$i]['cell'] = array($Cmspages['CmsPage']['id'], $title, $description, $action);
					$i++;
				}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}

	public function admin_changestatus()
	{

		if ($this->request->is('ajax'))
		{
			$myData = $this->request->data;
			//prd($myData);
			$this->loadModel('CmsPage');
			$data['CmsPage']['id'] = $myData['id'];
			$data['CmsPage']['status'] = $myData['status'] == "1" ? "0" : "1";
			$this->CmsPage->id = $myData['id'];
			if ($this->CmsPage->save($data))
			{
				echo '1';
			}
			else
			{
				echo '0';
			}
			exit;
		}
		else
		{
			
		}
	}

	public function admin_delete()
	{
		if ($this->request->is('ajax'))
		{
			$myData = $this->request->data;
			//prd($myData);
			$this->loadModel('CmsPage');
			$data['CmsPage']['id'] = $myData['id'];
			$data['CmsPage']['status']= "2";
			$this->CmsPage->id = $myData['id'];

			if ($this->CmsPage->save($data))
			{
				echo '1';
			}
			else
			{
				echo '0';
			}
			exit;
		}
		else
		{
			
		}
	}

	public function get_content()
	{

		$this->layout = 'ajax';
		$this->autoRender = false;

		if ($this->request->is('ajax'))
		{

			$title = $this->request->query('title');
			$conditions = array('status !=' => '2');

			if ($title == 'terms')
			{
				$conditions['id'] = '3';
			}
			elseif ($title == 'files')
			{
				$conditions['id'] = '4';
			}
			else
			{
				echo '0';
				exit;
			}

			$PageRequested = $this->CmsPage->find('first', array('conditions' => $conditions));

			if (isset($PageRequested) && !empty($PageRequested))
			{
				$responseArray = array('Title' => $PageRequested['CmsPage']['title'],
					'Body' => $PageRequested['CmsPage']['description']
				);

				$responseString = json_encode($responseArray);
				echo $responseString;
				exit;
			}
			else
			{
				echo '0';
				exit;
			}
		}
		else
		{
			echo '0';
			exit;
		}
	}
	
	
	public function index($key=null)
	{
		//$this->layout = 'innerpages';
		$this->loadModel('CmsPage');
		$data = $this->CmsPage->findByUniqueName($key);
		$this->set("cmsPageData", $data);
	}
	
	/*public function aboutus()
	{
		$this->loadModel('CmsPage');
		$cmsPageData = $this->CmsPage->findById(1);
		//prd($cmsPageData);
		$this->set("cmsPageData", $cmsPageData);
	}*/
}
