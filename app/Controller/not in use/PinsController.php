<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class PinsController extends AppController
{

	public function beforeFilter()
	{
		parent::beforeFilter();
		$arr = array("detail");
		$this->Auth->allow($arr);
	}
	
	public function addpin()
	{
		$request = $this->request;
		if ($request->is('ajax'))
		{
			$user_type = $this->Auth->User('user_type'); //$user_type = 3;
			$user_id = $this->_getCurrentUserId();
			$LocationTypeData = Configure::read('LocationType');
			
			$this->loadModel("Sport");
            
			$SportsData = $this->Sport->find("list", array(
				'conditions' => array('status'=>1),
				'recursive' => -1
			));
			
			$location_type = $request->query('loc_type');
            
			$sliceUpto = 1;
			switch ($user_type) {
				case 3 : 
					$sliceUpto = 3;
					break;
				case 2 : 
					$sliceUpto = 2;
					break;
				default :
					$sliceUpto = 1;
					break;
			}
			
			if ($request->is('post') && !empty($request->data)) 
			{
				$data = $request->data;
			
				$fields = array_keys($data["Pin"]);
				$tbl_fields = array('mon_isclosed', 'tue_isclosed', 'wed_isclosed', 'thu_isclosed', 'fri_isclosed', 'sat_isclosed', 'sun_isclosed');
				
				/*pr($fields);
				pr($tbl_fields);
				prd(array_diff($tbl_fields, $fields));*/
				
				$image_file = array();
				$data['Pin']['user_id'] = $user_id;
				
				if (!empty($data['Pin']['image'])) {
					
					$image_file = $data['Pin']['image'];
					$validateImage = $this->_validatePinImageSize($image_file);
					
					if ($validateImage!==TRUE){
						$response = array(
							"status" => '0',
							"msg" => __($validateImage),
						);
						echo json_encode($response); exit;
					}
				}
				unset($data['Pin']['image']);
				
				$location_type = $data['Pin']['location_type'];
				
				$this->loadModel("Pin");
				if ($this->Pin->save($data)) 
				{
					$lastId = $this->Pin->getLastInsertID();
					// image upload
					if (!empty($image_file) && isset($image_file["name"]))
					{
						$prefix = "Pin_".$lastId;
						$image_name = $this->_moveUploadFile($image_file, PATH_UPLOAD_PIN_IMAGE, $prefix);
						if ($image_name){
							$this->Pin->id = $lastId;
							$this->Pin->saveField('image', $image_name);
						}
					} 
					elseif (!empty($data["Pin"]["uploaded_images"])) 
					{
						$images = $data["Pin"]["uploaded_images"];
						$uploadedImages = explode(",", $images);
						$newImages = array();
						foreach ($uploadedImages as $img)
						{
							$oldPath = PATH_UPLOAD_TEMP . $img;
							if (file_exists($oldPath))
							{
								list(, $ext) = explode('.', $img);
								$new_name = "Pin_" . $lastId ."_". uniqid() . '.' . $ext;
								$newImages[] = $new_name;
								$newPath = PATH_UPLOAD_PIN_IMAGE . $new_name;
								$r = rename($oldPath, $newPath);
								//unlink($oldPath);
							}
						}
						if (!empty($newImages))
						{
							$images = implode(',', $newImages);
							$this->Pin->id = $lastId;
							$this->Pin->saveField('image', $images);
						}
					}
					
					$response = array(
						"status" => '1',
						"msg" => __('Pin added successfully'),
					);
					echo json_encode($response); exit;
				}
			}
			
			$LocationTypeData = array_slice($LocationTypeData, 0, $sliceUpto, true);
			$this->set(compact('location_type', 'user_type', 'LocationTypeData', 'SportsData'));
		}
		else
		{
			$this->render('/nodirecturl');
		}
	}
	
	/**
	 * 
	 */
	public function pinimageupload()
	{
		$request = $this->request;
		if ($request->is('ajax'))
		{
			$response = array(
				'status' => 0,
				'msg' => __('Invalid Request')
			);
			if ($request->is('post'))
			{
				$data = $request->data("Pin");
				
				if (!empty($data) && is_array($data))
				{
					$validateImage = $this->_validatePinImageSize($data['image']);
					if ($validateImage!==TRUE){
						$response['msg'] = __($validateImage);
						echo json_encode($response); exit;
					}
					
					$user_id = $this->_getCurrentUserId();
					$org_name = $data['image']['name'];
					$prefix = 'UserPin_'.$user_id;
					$new_name = $this->_moveUploadFile($data['image'], PATH_UPLOAD_TEMP, $prefix);
					
					if ($new_name)
					{
						$response = array(
							'status' => 1,
							'msg' => __('File uploaded successfully'),
							'data' => array(
								'org' => $org_name,
								'new' => $new_name,
							)
						);
					}
					else
					{
						$response['msg'] = __('Error uploading file');
					}
				}
			}
			echo json_encode($response); exit;
		}
		else
		{
			$this->render('/nodirecturl');
		}
		prd($request->data);
		echo "1"; exit;
	}
	
	/**
	 * 
	 * @param array $image
	 * @return bool TRUE or string ERROR Msg.
	 */
	protected function _validatePinImageSize($image=array())
	{
		$imgSz = getimagesize($image["tmp_name"]);
		$valid['minW'] = '660';
		$valid['minH'] = '380';
		$valid['maxW'] = '1280';
		$valid['maxH'] = '760';
		
		if (($imgSz[0] >= $valid['minW'] && $imgSz[1] >= $valid['minH']) && ($imgSz[0] <= $valid['maxW'] && $imgSz[1] <= $valid['maxH']))
		{
			return true;
		}
		else
		{
			$msg = "Image size should be within ".$valid['minW']. 'px X '.$valid['minH']. "px and ".$valid['maxW']. 'px X '. $valid['maxH'].'px';
			return $msg;
		}
	}
	
	public function delpin()
	{
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
				$response["msg"] = __("Invalid Pin Id");
				if (!empty($id))
				{
					$user_id = $this->_getCurrentUserId();
					$this->loadModel("Pin");
					$data = $this->Pin->find("first", array(
						"conditions" => array("id"=> $id,"user_id"=>$user_id, "status"=>1),
						"recursive" => -1
					));
					if (!empty($data))
					{
						$this->Pin->id = $id;
						$save = array(
							"Pin" => array("status"=>2)
						);
						if ($this->Pin->save($save)){
							$response["status"] = 1;
							$response["msg"] = __("Pin deleted successfully");
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
	

	public function detail($id = NULL)
	{

		$this->loadModel("Pin");

		$this->Pin->bindModel(
			array('hasMany' => array(
					'Product' => array(
						'className' => 'Product',
						'foreignKey' => 'pin_id',
					),
					'Review' => array(
						'className' => 'Review',
						'foreignKey' => 'pin_id',
						'conditions' => array('Review.status = 1')
					),
				)
			)
		);
		//$pinData = $this->Pin->findById($id);
		$pinData = $this->Pin->find("all", array(
			"conditions" => array("Pin.id" => $id),
			"recursive" => "2"
		));
		$pinData = $pinData[0];
		//prd($pinData);
		//echo $type;exit;
		$UserId = $this->_getCurrentUserId();
		$this->set("UserId", $UserId);
		$this->set("pinData", $pinData);
		//prd($pinData);
		if (count($pinData) > 0)
		{
			if (!(isset($pinData["Pin"]["location_type"]) && ( (in_array($pinData["Pin"]["location_type"], array("1", "2", "3"))))))
			{
				$this->redirect(array('admin' => false, 'controller' => 'index', 'action' => 'index'));
			}
		}
		else
		{
			$this->redirect(array('admin' => false, 'controller' => 'index', 'action' => 'index'));
		}
	}

	public function edit($id = NULL)
	{

		$this->loadModel("Pin");
		$this->loadModel("Sport");
		$UserId = $this->_getCurrentUserId();

		$this->Pin->bindModel(
			array('hasMany' => array(
					'Product' => array(
						'className' => 'Product',
						'foreignKey' => 'pin_id',
					)
				)
			)
		);

		$pinData = $this->Pin->find("first", array(
			"conditions" => array(
				"Pin.id" => $id,
				"Pin.user_id" => $UserId,
				"Pin.status" => 1
			),
			"recursive" => "2"
		));
        
        //prd($pinData);
        
		if (!empty($pinData))
		{
			// task
			$SportsData = $this->Sport->find("list", array(
				'conditions' => array('status' => 1),
				'recursive' => -1
			));
			$this->set("UserId", $UserId);
			$this->set("pinData", $pinData);
			$this->set("SportsData", $SportsData);

			if (($this->request->is('post')) || ($this->request->is('put')))
			{
				$data = $this->request->data;

				/* //pr($data);
				  $ar1 = array_keys($data["Pin"]);
				  //pr( $ar1);
				  $dbarr = array( "mon_isclosed","tue_isclosed","wed_isclosed", "thu_isclosed","fri_isclosed","sat_isclosed","sun_isclosed");

				  //prd($ar1);

				  $res = array_diff( $ar1, $dbarr);

				  prd($res); */

				if ($s = $this->Pin->save($data))
				{
					$this->Session->setFlash(__("Pin updated successfully."), 'flash_success_front');
					$this->redirect(array('controller' => 'pins', 'action' => 'detail', $id));
				}
			}
			else
			{
				$this->request->data = $pinData;
			}
		}
		else
		{
			$this->Session->setFlash(__("User not authorized to edit this pin."), 'flash_error_front');
			$this->redirect(array('controller' => 'pins', 'action' => 'detail', $id));
		}
		// return
	}

}
