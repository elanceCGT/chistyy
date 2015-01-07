<?php
/**
 * Product Controller
 * @author:	Dharmendra Bakrecha
 * @created: 16-12-2014 
 */

App::uses('AppController', 'Controller');

class ProductsController extends AppController{

	public function beforeFilter(){	parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	public function index($shopid = NULL) {	
        $this->set('title_for_layout','products');
        $this->loadModel('Pin');
        $currentUser  = $this->_getCurrentUserId();
            
        $proCondition = array();
        $proCondition['Product.status'] = 1;
        
        if(!empty($shopid)){
            $proCondition['Product.pin_id'] = $shopid;
            $this->set('statusShop' , '1');
        }else{
            $this->set('statusShop' , '2');
        }
        
        $productData = $this->Product->find('all',array(
            'conditions' => $proCondition,
            'order' => array('Product.created DESC'),
        ));
        
         /* Filling shop data when shopid not empty */
        $this->Pin->bindModel(array(
            'hasMany' => array(
                'Review' => array(
                    'foreignKey' => 'pin_id',
                    'conditions' => array('Review.status = 1')
                ),
            )
        ));

        if (!empty($shopid)) {
            $pinCondition = array();
            $pinCondition['Pin.id'] = $shopid;
            $pinRow = $this->Pin->find('first', array(
                'conditions' => $pinCondition,
                'recursive' => 2
            ));
            $this->set('shopData', $pinRow);
        } else {
            $pinCondition = array();
            $pinCondition['Pin.id'] = $productData[0]['Product']['pin_id'];
            $pinRow = $this->Pin->find('first', array(
                'conditions' => $pinCondition,
                'recursive' => 2
            ));
            $this->set('shopData', $pinRow);
        }
        //pr($pinRow);
        /* Filling shop data END */

        $this->set('currentUser',$currentUser);
		$this->set('productData',$productData);
	}
    
    public function add(){
        $request = $this->request;
		if ($request->is('ajax'))
		{
			$response = array();
			$response['status'] = 0;
			$response['msg'] = __('Invalid Request Type');
			$response['data'] = '';
			
			$this->loadModel('Product');
			if ($request->is('post') || $request->is('put'))
			{
                if (!empty($request->data("Product"))) 
				{
					$data['Product'] = $request->data('Product');
                    
                    $this->Product->set($data);
                    
                    if(isset($data['Product']['image']) && !empty($data['Product']['image']))
                    {
                        $file = $data['Product']['image'];
                        //pr($file);
                        if (!empty($file['name'])) {
                                $filePart = explode('.', $file['name']);
                                $ext = $filePart[1];
                                //pr($ext);
                                $file_extension = array('png','gif','jpeg','jpg','bmp');

                                if(in_array($ext,$file_extension)){
                                    $newFileName = "Product_" . uniqid() . '.' .$ext;
                                    $destination = PATH_UPLOAD_PRODUCT_IMAGE . $newFileName;
                                    $moved = move_uploaded_file($file['tmp_name'], $destination);
                                    //pr($newFileName);
                                    if ($moved){
                                        $data['Product']['image'] = $newFileName;
                                        $this->Product->data['Product']['image'] = $newFileName;
                                    }
                                }
                        }
                    }else{
                        unset($data['Product']['image']);
                        unset($this->Product->data['Product']['image']);
                    }
                    
                    $data['Product']['user_id'] = $this->_getCurrentUserId();
                    //prd($this->Product->data);
					if ($this->Product->validates())
					{
						$data['Product']['status'] = '1';
						$this->Product->save($data);

						$response['status'] = 1;
						$response['msg'] = __('New product add successful');
						
						echo json_encode($response); exit;
					}
				}
			}
            
            if ($request->is('get'))
            {
                $reqData = $this->request->query;
                if(isset($reqData['pro_id']) && !empty($reqData['pro_id'])){
                    $productRow = $this->Product->findById($reqData['pro_id']);
                    $this->request->data = $productRow;
                }
                
                if(isset($reqData['pin_id']) && !empty($reqData['pin_id'])){
                    $this->set('pin_id',$reqData['pin_id']);
                }
            }
			$this->render("add");
		}
		else
		{
			$this->render('/nodirecturl');
		}
    }
    
    public function getpin(){
        $request = $this->request;
        $this->loadModel("Pin");
        $currentUser = $this->_getCurrentUserId();
        
		if ($request->is('ajax'))
		{
			$response = array();
			$response['status'] = 0;
			$response['msg'] = __('Invalid Request Type');
			$response['data'] = '';
			
            if ($request->is('get'))
            {
                $reqData = $this->request->query;
                if(!empty($reqData['pin_id'])){
                    
                    $this->Pin->bindModel(array(
                        'hasMany' => array(
                            'Review' => array(
                                'foreignKey' => 'pin_id',
                                'conditions' => array('Review.status = 1')
                            ),
                        )
                    ));
                    
                    $pinCondition = array();
                    $pinCondition['Pin.id'] = $reqData['pin_id'];
                    $pinRow = $this->Pin->find('first',array(
                        'conditions' => $pinCondition,
                        'recursive' => 2
                    ));
                    
                    $this->set('shopData', $pinRow);
                    $this->set('currentUser',$currentUser);
                }
            }
			$this->render("getpin");
		}
		else
		{
			$this->render('/nodirecturl');
		}
    }
    
    
    public function delete(){
        $request = $this->request;
		if ($request->is("ajax"))
		{
			$response = array(
				"status" => 0,
				"msg" => __("Invalid Request")
			);
			if ($request->is("post"))
			{
				$id = $request->data("id");
				$response["msg"] = __("Invalid product Id");
				if (!empty($id))
				{
					$user_id = $this->_getCurrentUserId();
					
					$data = $this->Product->find("first", array(
						"conditions" => array("id"=> $id,"user_id"=>$user_id, "status"=>1),
						"recursive" => -1
					));
					if (!empty($data))
					{
						$this->Product->id = $id;
						$save = array(
							"Product" => array("status"=>2)
						);
						if ($this->Product->save($save)){
							$response["status"] = 1;
							$response["msg"] = __("Product deleted successfully");
						}
					}
				}
			}
			echo json_encode($response); exit;
		}
		else
		{
			$this->render('/nodirecturl');
		}
    }
    
     public function hitcount(){
        $request = $this->request;
        $this->loadModel('Hit');
		if ($request->is("ajax"))
		{
			$response = array(
				"status" => 0,
				"msg" => __("Invalid Request")
			);
			if ($request->is("post"))
			{
				$product_id = $request->data("id");
				$response["msg"] = __("Invalid product Id");
               
				if (!empty($product_id))
				{
                    $r_addr = $_SERVER['REMOTE_ADDR'];  //  store remote address
                    $user_id = $this->_getCurrentUserId();
                    if(empty($user_id)){
                        $user_id = 0;
                    }
                    
                    $curr_date = date('Y-m-d');
                    $condition = array();
                    $condition['Hit.ip_addr'] = $r_addr;
                    $condition['Hit.product_id'] = $product_id;
                    $condition['Hit.user_id'] = $user_id;
                    //$condition['DATE( Hit.createds )'] = 'CURDATE()';
                    $condition['DATE( Hit.created ) >='] = $curr_date;
					
					$dataHit = $this->Hit->find("first", array(
						"conditions" => $condition,
					));
                    
                    if (empty($dataHit))
					{
						$saveData = array();
                        $saveData['Hit']['ip_addr'] = $r_addr;
                        $saveData['Hit']['product_id'] = $product_id;
                        $saveData['Hit']['user_id'] = $user_id;
                        $saveData['Hit']['status'] = 1;
                        
						if ($this->Hit->save($saveData)){
                            $this->Product->updateAll(
                                array('Product.hit_count'=>'Product.hit_count + 1'), 
                                array('Product.id'=>$product_id));
                            
							$response["status"] = 1;
							$response["msg"] = __("Hit count add successfully");
						}
                    }else{
                        $response["status"] = 1;
                        $response["msg"] = __("Hit alerdy added");
                    }
				}
			}
			echo json_encode($response); exit;
		}
		else
		{
			$this->render('/nodirecturl');
		}
    }
}