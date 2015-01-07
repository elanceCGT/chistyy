<?php
App::uses('AppModel', 'Model');
class Customer extends AppModel{
	public $tablePrefix = 'booking_';
	public $useTable  = 'customers';

	public $validate = array(
	
			'customer_name' => array(
					'rule1' => array(
							'rule' => 'notEmpty',
							'message' => "Customer Name can't empty",
						)
				),
				
			'customer_gender' => array(
        	'rule1' => array(
             'rule' => 'notEmpty',
             'message' => '  Select either Male or Female.'
         	)
				),
				
			'customer_dateofbirth' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "Date Of Birth can't empty",
								'last' => true
        			),
						'rule2' => array(
        				'rule' => array('date', 'ymd'),
        				'message' => 'Enter a valid date in YY-MM-DD format.',
        			)		
				),
				
			'customer_number' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "Contact No. can't empty",
								'last' => true
        			),
						'rule2' => array(
        				'rule' => array('Numeric'),
								'message' => 'Only numbers allowed',
        			)	
				),
				
			'customer_address' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "Address can't empty",
								'last' => true
        			),
						'rule2' => array(
        				'rule' => array('minLength', 15),
        				'message' => "Address Minimum length of 15 characters"
        			),	
				),
				
			'customer_city' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "City Name can't empty"
        			)
				),
				
			'customer_state' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "State Name can't empty"
        			)
				),
				
			'customer_zip_code' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "Zip Code can't empty",
								'last' => true
        			),
				),
			  
		);
}