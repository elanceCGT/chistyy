<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
class Contact extends AppModel{
	public $tablePrefix = 'booking_';
	public $useTable  = 'contactus';
	//public $belongsTo  = array('Category' => array('counterCache'=>true));
	
	/*public $hasOne = array(
		'ServiceProviderService' => array('className' => 'ServiceProviderService', 'foreignKey' => 'servic_cd')
	);*/

	
	/*public $belongsTo = array(
        'Category' => array(
            'counterCache' => array(
                'service_count' => array('Service.service_status !=' => 2)
            ),
            'dependent' => true
        )
    );*/

	/*public function contactMail($data='',$adminmail = 'admin@chistyy.com')
	{
		if(!empty($data)){
			$Email = new CakeEmail();
			$Email->from(array($data['Contact']['contact_email'] => 'Request For Contact'))
			->to($adminmail)
			->subject($data['Contact']['contact_subject'])
			->send($data['Contact']['contact_message']);echo "dfd"; exit;
			
		}	
	}*/	
}