<?php
App::uses('AppModel', 'Model');
class Cleaner extends AppModel{
	//public $tablePrefix = 'booking_';
	//public $useTable  = 'cleaners';
	public $belongsTo = 'User';
}