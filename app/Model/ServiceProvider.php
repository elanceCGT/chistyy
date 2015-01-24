<?php
App::uses('AppModel', 'Model');
class ServiceProvider extends AppModel{
	
	public $belongsTo = 'User';
	
	/*public $hasMany = array(
		'ServiceProviderService' => array('className' => 'ServiceProviderService', 'foreignKey' => 'user_id')
    );*/

	public $validate = array(
	
			'provider_name' => array(
					'notEmpty' => array(
							'rule' => 'notEmpty',
							'message' => "Provider Name can't empty"
						)
				),
			
			'contact_name' => array(
					'notEmpty' => array(
							'rule' => 'notEmpty',
							'message' => "Customer Name can't empty"
						)
				),	
				
			'contact_number' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Contact No. can't empty",
								'last' => true
        			),
						'Numeric' => array(
        				'rule' => array('Numeric'),
								'message' => 'Only numbers allowed',
        			),
				),
				
			'street_address' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Address can't empty",
								'last' => true
        			),
						'minLength' => array(
        				'rule' => array('minLength', 15),
        				'message' => "Address Minimum length of 15 characters"
        			),	
				),
				
			'provider_city' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "City Name can't empty"
        			)
				),
				
			'provider_state' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "State Name can't empty"
        			)
				),
				
			'provider_zip_code' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Zip Code can't empty",
							),
				),
			
			'provider_website' => array(
        		'url' => array(
								'rule' => 'url',
        				'message' => "Enter Correct Provider Website Url",
								'allowEmpty' => true,
							),	
				),
			'provider_email_address' => array(
        		'email' => array(
        				'rule' => 'email',
        				'message' => "Enter Valid Provider Email.",
								'allowEmpty' => true
							),
				),
			
			'provider_logo' => array(
	            'extension'=>array(
		            'rule' => array('extension',array('jpeg', 'jpg', 'gif', 'png')),
		            'required' => false,           
		            'message' => 'Please Select Valid  File Format.',
		            'on' => 'create',
		            'last'=>true
	        	)
        	),
			  
		);
	
		
}