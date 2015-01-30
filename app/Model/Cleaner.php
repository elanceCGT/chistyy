<?php
App::uses('AppModel', 'Model');
class Cleaner extends AppModel{
	//public $tablePrefix = 'booking_';
	//public $useTable  = 'cleaners';
	public $belongsTo = 'User';

	/*var $belongsTo = array(
        'Countrie' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );*/ 
	public $validate = array(
	
			'service_provider_id' => array(
					'notEmpty' => array(
							'rule' => 'notEmpty',
							'message' => "Select Service Provider"
						)
				),
			'service_id' => array(
					'notEmpty' => array(
							'rule' => 'notEmpty',
							'message' => "Select Service"
						)
				),		
			
			'cleaner_name' => array(
					'notEmpty' => array(
							'rule' => 'notEmpty',
							'message' => "Cleaner Name can't empty"
						)
				),	
			
			'cleaner_gender' => array(
        	'notEmpty' => array(
             'rule' => 'notEmpty',
             'message' => '  Select either Male or Female.'
         	)
				),
				
			'cleaner_dateofbirth' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Date Of Birth can't empty",
								'last' => true
        			),
						'date' => array(
        				'rule' => array('date', 'ymd'),
        				'message' => 'Enter a valid date in YY-MM-DD format.',
        			)		
				),
					
			'cleaner_caontact_number' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Cleaner Contact No. can't empty",
								'last' => true
        			),
						'Numeric' => array(
        				'rule' => array('Numeric'),
								'message' => 'Only numbers allowed',
        			),
				),
				
			'cleaner_address' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Cleaner Address can't empty",
								'last' => true
        			),
						'minLength' => array(
        				'rule' => array('minLength', 15),
        				'message' => "Address Minimum length of 15 characters"
        			),	
				),
				
			'cleaner_city' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Cleaner City Name can't empty"
        			)
				),
				
			'cleaner_state' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Cleaner State Name can't empty"
        			)
				),
				
			'cleaner_zip_code' => array(
        		'notEmpty' => array(
        				'rule' => 'notEmpty',
        				'message' => "Cleaner Zip Code can't empty",
							),
				),
		
		);
}