<?php

App::uses('AppModel', 'Model');

class Pin extends AppModel
{
	public $validate = array();
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
        'Sport' => array(
			'className' => 'Sport',
			'foreignKey' => 'sports_type'
		)
	);
	
	public function getUserPins($user_id, $fields = array(), $type = null)
	{
		$conditions = array(
			"Pin.user_id" => $user_id,
			"Pin.status" => 1
		);
		if ($type){
			$conditions["Pin.location_type"] = $type;
		}
		if (empty($fields)) {
			$fields = array("Pin.*", "User.full_name", "Sport.name");
		}
		
		$data = $this->find("all", array(
			"conditions" => $conditions,
			"order" => array("Pin.created DESC"),
			"fields" => $fields,
		));
		return $data;
	}
}
