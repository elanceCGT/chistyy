<?php
/**
 * Reviews Controller
 * @author:	Dharmendra Bakrecha
 * @created: 20-12-2014 
 */

App::uses('AppController', 'Controller');

class ReviewsController extends AppController{

	public function beforeFilter(){	parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
    public function index(){
        
    }
    
    public function admin_index(){
        $this->set('title_for_layout','Reviews Contents');
        array_push($this->AdminListings, array('controller'=>'reviews','action'=>'index','heading'=>'Reviews'));
        $this->set('Listings',$this->AdminListings);   
    }
    
    public function admin_grid(){
		
		$page  = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx  = $this->request->query['sidx'];
		$sord  = $this->request->query['sord'];
		
		if(!$sidx) $sidx =1;
		$order_by = $sidx.' '.$sord;
		
		$conditions = array();
		
    	$count = $this->Review->find('count',array(
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
        
        $join = array(
                array(
                'table' => 'sp_pins',
                'alias' => 'Pin',
                'type' => 'left',
                'conditions' => array(
                    'Review.pin_id = Pin.id'
                ),
            ),
        );
		
		$reviewList = $this->Review->find('all',array(
			  'conditions' =>$conditions,
				'order' => $order_by,
                'joins' => $join,
				'limit' => $limit,
				'offset' => $start,
                'fields' => '*'
			)
		);
		
		$temp = array();
		
		$responce = new stdClass();
		$responce->page = $page; 
		$responce->total = $total_pages; 
		$responce->records = $count; 

		$i=0; 
		$j	=	(($page-1)*$limit)+1;
			
		if(is_array($reviewList))
		{
			//prd($reviewList);
			$temp = array();
			foreach($reviewList as $review):
			{
				
				$pin 		 = $review['Pin']['name'];
				$reviewby = $review['User']['first_name'] . " " . $review['User']['last_name'];
				$rating = $review['Review']['rating'];
                $desc = $review['Review']['description'];
                $created = $review['Review']['created'];
				
				$action = '';
				
				if($review['Review']['status'] == 0){	
					$action .= '<i class="fa fa-circle fa-lg clrDisable" onclick="changeCmsStatus('.$review['Review']['id'].',0)" title="Change Status"></i>';
				}
				else if($review['Review']['status'] == 1){
					$action .= '<i class="fa fa-circle fa-lg clrEmable" onclick="changeCmsStatus('.$review['Review']['id'].',1)" title="Change Status"></i>';
				}
				
				//$action .= '&nbsp;&nbsp;&nbsp;<a href="'.$this->webroot.'admin/email_contents/edit/'.$review['Review']['id'].'" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
        		$responce->rows[$i]['id']=$review['Review']['id'];
				$responce->rows[$i]['cell']=array($j,$pin,$reviewby,$rating,$desc,$created,$action); 
				$i++;$j++;
			}
			endforeach;
			
		}
		echo json_encode($responce); exit;
	}
    
    
    
    public function add(){
        $request = $this->request;
		if ($request->is('ajax'))
		{
			$response = array();
			$response['status'] = 0;
			$response['msg'] = __('Invalid Request Type');
			$response['data'] = '';
			
			if ($request->is('post') || $request->is('put'))
			{
                if (!empty($request->data("Review"))) 
				{
					$data['Review'] = $request->data('Review');
                    $data['Review']['user_id'] = $this->_getCurrentUserId();
                    //prd($data);
                    $this->Review->set($data);
                    
                    
                    //prd($this->Product->data);
					if ($this->Review->validates())
					{
						$data['Review']['status'] = '1';
						$this->Review->save($data);

						$response['status'] = 1;
						$response['msg'] = __('New review add successful');
						
						echo json_encode($response); exit;
					}
				}
			}
            
            if ($request->is('get'))
            {
                $reqData = $this->request->query;
                
                $this->set("shop_id",$reqData['shop_id']);
                
            }
			$this->render("add");
		}
		else
		{
			$this->render('/nodirecturl');
		}
    }
}

