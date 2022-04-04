<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->database();
	}

	public function add_event()
	{
		if(isset($_POST) && !empty($_POST)){
			// echo "<pre>";print_r($_POST);exit;
			$this->load->library('form_validation'); 
			$this->form_validation->set_rules('event_name', "Event Name", "required|is_unique[event.event_name]");
			$this->form_validation->set_rules('event_end_type', "Event End Type", "required");
			$this->form_validation->set_rules('event_start_date', "Event Start Date", "required|callback_date_validation");
			$this->form_validation->set_rules('event_end_date', "Event End Date", "callback_end_date_validation");
			$this->form_validation->set_rules('event_repeat_number', "Event Repeat Number", "required|numeric|is_natural");
			$this->form_validation->set_rules('event_occurance', "After Occurrence", "callback_event_occurance");

			if ($this->form_validation->run() == FALSE){
				$this->load->view('add_event', $_POST);
			}else{
				$this->load->model('Events','events');
				$this->events->add_event(0);
				redirect(base_url('event/list'));
			}

			// $this->load->view('add_event');
		}else{
			$this->load->view('add_event');
		}
	}

	public function delete($id){
		// $data['return'] = 1;
		// echo json_encode($data['return']);exit;
		$this->db->where('id', $id);
		$query = $this->db->delete('event');
		if($query){
			$data['return'] = 1;
			echo json_encode($data['return']);exit;
		}else{
			$data['return'] = 0;
			echo json_encode($data['return']);exit;
		}	
	}

	public function list(){
		$query = $this->db->get('event');
		$event_data['list'] = $query->result_array();
		$this->load->view('event_list',$event_data);
	}

	public function view($id){
		$this->db->where('id', $id);
		$query = $this->db->get('event');
		$data = array();
		$event_data = $query->result_array()[0];
		if(is_array($event_data) && !empty($event_data)){
			$data['name'] = $event_data['event_name'];
			$data['date_list'] = $this->get_between_dates($event_data['event_start_date'],$event_data['event_end_date'], $event_data['event_repeat_duration'], $event_data['event_repeat_number'], $event_data['event_end_type'], $event_data['event_occurance']);
			$data['total'] = count($data['date_list']);
		}else{
			echo "No data found.";
		}
		echo json_encode($data);exit;
	}

	/* date listing between start date and end date or with number of occrrance */ 
	public function get_between_dates($start_date, $end_date, $duration_type, $duration_number, $event_end_type, $event_occurance, $format="Y-m-d"){
		$dates = array();
		$current_pointer_date = strtotime($start_date);
		// $end_date = strtotime($end_date);
		$plus_time = "+{$duration_number} {$duration_type}"; 
		if($event_end_type == "with_occrance"){
			$number = 0;
			$duration_number_more = ($duration_number * $event_occurance)+1;
			$plus_time = "+{$duration_number} {$duration_type}"; 
			$last_date_calc = "+{$duration_number_more} {$duration_type}"; 
			$end_date = strtotime($last_date_calc, $current_pointer_date);
		}else{
			$end_date = strtotime($end_date);
		}
		while($current_pointer_date <= $end_date){
			if(isset($number)){
				if($number < $event_occurance){
					$new_date = date($format, $current_pointer_date);
					$all_dates[] = array('date'=>date($format, $current_pointer_date), 'day' => date('l', $current_pointer_date));
					$current_pointer_date = strtotime($plus_time, $current_pointer_date);
					if($event_end_type == "with_occrance"){
						$number++;
					}
				}else{
					return $all_dates;
				}
			}else{
				$all_dates[] = array('date'=>date($format, $current_pointer_date), 'day' => date('l', $current_pointer_date));
				$current_pointer_date = strtotime($plus_time, $current_pointer_date);
			}
		}
		return $all_dates;
	}

	public function date_validation($date){
		// date format --- "2018-04-25"
		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][1-9]|3[0-1])$/", $date)){
			$date_explode = explode('-', $date);
			if(checkdate($date_explode[1], $date_explode[2], $date_explode[0])){
				return true;
			}else{
				$this->form_validation->set_message('date_validation', "Please enter valid start date.");
				return false;
			}
		}else{
			$this->form_validation->set_message('date_validation', "Please enter valid date.");
			return false;
		}
	}

	public function end_date_validation($date){
		// date format --- "2018-04-25"
		// echo "------<pre>";print_r($_POST);//exit;
		if($_POST['event_end_type'] == "with_end_date"){
			if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][1-9]|3[0-1])$/", $date)){
				$date_explode = explode('-', $date);
				if(checkdate($date_explode[1], $date_explode[2], $date_explode[0])){
					return true;
				}else{
					$this->form_validation->set_message('end_date_validation', "Please enter valid end date.");
					return false;
				}
			}else{
				$this->form_validation->set_message('end_date_validation', "Please enter valid end date.");
				return false;
			}
		}else{
			return true;
		}
	}

	public function event_occurance($data){
		if($_POST['event_end_type'] == "with_occrance"){
			if(ctype_digit($_POST['event_occurance'])){
				return true;
			}else{
				$this->form_validation->set_message('event_occurance', "Please enter a valid number for occurance.");
				return false;
			}
		}
	}

}
