<?php
App::uses('AppModel', 'Model');
class Service extends AppModel{
	//public $belongsTo  = array('Category' => array('counterCache'=>true));
	
	public $validate = array(
        'service_name' => array(
					'rule1' => array(
							'rule' => 'notEmpty',
							'message' => "Service Name can't empty.",
							'last' => true
						),
					'rule2' => array(
							'rule' => 'isUnique',
        			'required' => 'create',
							'message' => "Duplicate Service Name."
						)	
        ),
				'category_id' => array(
					'required' => true,
					'rule' => array('notEmpty'),
        	'message' => "Select Category."
        ),
				'hourly_rate' =>array(
					'Rule-1' => array(
						'rule' => array('notEmpty'),
						'message' => "Hourly Rate can't empty.",
						'last' => true
					),
					'Rule-2' => array(
						'rule' => array('Numeric'),
						'message' => 'Only numbers allowed',
						'last' => true
					),
				),
				'minimum_hour' =>array(
					'Rule-1' => array(
						'rule' => array('notEmpty'),
						'message' => "Minimum Hour can't empty.",
						'last' => true
					),
					'Rule-2' => array(
						'rule' => array('Numeric'),
						'message' => 'Only numbers allowed',
					)
				),
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