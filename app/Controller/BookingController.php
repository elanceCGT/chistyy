<?php
class BookingController extends AppController{

	public function admin_bookinglist(){
		//echo "bookin"; exit;
		$this->set('title_for_layout', 'Booking List');
	}

	public function admin_index(){
		//echo "bookin"; exit;
		$this->set('title_for_layout', 'Booking List');
	}
	

	public function admin_mainbookinglist(){ 
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		//$conditions = array('Booking.category_status <>' => 2, "Category.parent_id" => 0);
		$conditions = '';

		$count = $this->Booking->find('count', array(
			'recursive' => -1,
			//'conditions' => $conditions,
			)
		);

		if ($count > 0)
		{
			$total_pages = ceil($count / $limit);
			//$total_pages = 2;

		}
		else
		{
			$total_pages = 0;
		}

		if ($page > $total_pages)
		{
			$page = $total_pages;
		}

		$start = $limit * $page - $limit;

		//$fields = array('Booking.*');
		
		//$conditions = array('Category.category_status <>' => 2, "Category.parent_id" => 0);

		$BookingList = $this->Booking->find(
			"all",
			array(
				'fields'=>array('Booking.*','Customers.*'),
				'joins'=>array(
					array(
						'table' => 'booking_customers',
						'alias' => 'Customers',
						'type' => 'LEFT',
						'conditions' => array('Booking.customer_id = Customers.user_id')
					)
				),
				//'group' => array('Category.id', 'Category.parent_id'), //fields to GROUP BY
				//'recursive' => 0,
				//'conditions' => $conditions
			)
		);

		/*$CategoryList = $this->Category->find('all', array(
			'conditions' => $conditions,
			'order' => $order_by,
			'limit' => $limit,
			'offset' => $start
			)
		);*/
		//prd($CategoryList);
		$temp = array();

		$responce = new stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;

		$i = 0;
		if (is_array($BookingList))
		{
			$temp = array();
			foreach ($BookingList as $key => $booking): {

					$title = $booking['Customers']['customer_name'].' '.$booking['Customers']['customer_lname'];
					
					/*$servicecount = " ";
					if(isset($booking['Category']['service_count']) && $booking['Category']['service_count']!=0)
					{
						$servicecount = '<a href="'. $this->webroot . 'admin/services/index/' . $booking['Category']['id'] .'/">('.$booking['Category']['service_count'].')</a>';
					}*/
					

					//$newservice = '<center><a href="services/add/'.$booking['Category']['id'].'" style="margin:2px;" class="btn btn-primary ">Add Service</a></center>';

					$action = '';
					$status = '';
					$delete = '';
					
					if ($booking['Booking']['booking_status]'] == 0)
					{
						$status .= '<center><i class="fa fa-circle fa-lg clrDisable" onclick="changeCategoryStatus(' . $booking['Booking']['id'] . ',0)" title="Change Status"></i></center>';
					}
					else if ($booking['Booking']['booking_status]'] == 1)
					{
						$status .= '<center><i class="fa fa-circle fa-lg clrEmable" onclick="changeCategoryStatus(' . $booking['Booking']['id'] . ',1)" title="Change Status"></i></center>';
					}

					$action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/category/editmain/' . $booking['Booking']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';

					$delete .= '<center><i class="fa fa-trash fa-lg" onclick="categorydelete(' . $booking['Booking']['id'] . ')" title="Delete Content"></i></center>'; 
					
					/*if ($booking[0]['subcatcnt']=="0") {
						$subcatcnt = '( 0 )';
					}else{
						$subcatcnt = $servicecount = '<a href="'. $this->webroot . 'admin/category/sub/' . $booking['Booking']['id'] .'/">( '.$booking[0]['subcatcnt'].' )</a>';
					}*/
					
					$responce->rows[$i]['id'] = $booking['Booking']['id'];

					//$responce->rows[$i]['cell'] = array($i+1, $title, $servicecount, $newservice, $status, $action, $delete);
					$responce->rows[$i]['cell'] = array($i+1, $title, $status, $action, $delete);
					$i++;
				}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}
}