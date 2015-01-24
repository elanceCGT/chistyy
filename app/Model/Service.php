<?php
App::uses('AppModel', 'Model');
class Service extends AppModel{
	//public $belongsTo  = array('Category' => array('counterCache'=>true));
	
	/*public $hasOne = array(
		'ServiceProviderService' => array('className' => 'ServiceProviderService', 'foreignKey' => 'servic_cd')
	);*/

	public $validate = array(
		'service_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Service Name can't empty.",
				'last' => true
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => "Duplicate Service Name."
			)
        ),
		'category_id' => array(
			'required' => true,
			'rule' => array('notEmpty'),
        	'message' => "Select Category.",
        	'rule' => array('comparison', '>', 0),
        	'message' => 'Please Select Main Category'
        ),
		'sub_category_id' => array(
			'required' => true,
			'rule' => array('notEmpty'),
        	'message' => "Select Category.",
        	'rule' => array('comparison', '>', 0),
        	'message' => 'Please Select Sub Category'
        )
	);

	public $belongsTo = array(
        'Category' => array(
            'counterCache' => array(
                'service_count' => array('Service.service_status !=' => 2)
            ),
            'dependent' => true
        )
    );
}