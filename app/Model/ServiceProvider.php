<?php
App::uses('AppModel', 'Model');
class ServiceProvider extends AppModel{
	
	public $belongsTo = 'User';
	
	public $validate = array(
	
			'provider_name' => array(
					'rule1' => array(
							'rule' => 'notEmpty',
							'message' => "Provider Name can't empty"
						)
				),
			
			'contact_name' => array(
					'rule1' => array(
							'rule' => 'notEmpty',
							'message' => "Customer Name can't empty"
						)
				),	
				
			'contact_number' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "Contact No. can't empty",
								'last' => true
        			),
						'rule2' => array(
        				'rule' => array('Numeric'),
								'message' => 'Only numbers allowed',
        			),
				),
				
			'street_address' => array(
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
				
			'provider_city' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "City Name can't empty"
        			)
				),
				
			'provider_state' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "State Name can't empty"
        			)
				),
				
			'provider_zip_code' => array(
        		'rule1' => array(
        				'rule' => 'notEmpty',
        				'message' => "Zip Code can't empty",
							),
				),
			
			/*'provider_website' => array(
        		'rule2' => array(
        				'rule' => 'url',
        				'message' => "Enter Correct Provider Website Url",
							),	
				),
			'provider_email_address' => array(
        		'rule1' => array(
        				'rule' => 'email',
        				'message' => "Enter Valid Provider Email.",
								'last' => true
        			),
				),*/
			
			'provider_logo' => array(
	            'rule1'=>array(
		            'rule' => array('extension',array('jpeg', 'jpg', 'gif', 'png')),
		            'required' => false,           
		            'message' => 'Please Select Valid  File Format.',
		            'on' => 'create',
		            'last'=>true
	        	)
        	),
			  
		);
	
		
}