<?php 
class ScheduleController extends AppController{
	public function admin_index($cat=0){
		$this->set('cat', $cat);
		$this->set('title_for_layout', 'Schedules');
	}
}?>