<?php
App::uses('AppModel', 'Model');
class Category extends AppModel{
	
	public $validate = array(
        'category_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Category Name can't empty.",
				'last' => true
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => "Duplicate Category Name."
			)
        )
    );
	
	public $hasMany = array(
		'Service' => array(
			'counterCache'=>true,
			'conditions'=>array(
				'Service.service_status !=' => 2
			)
		)
	);
}