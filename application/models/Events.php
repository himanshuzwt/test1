<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Model {

    public $id;
    public $event_name;
    public $event_start_date;
    public $event_repeat_number;
    public $event_repeat_duration;
    public $event_end_type;
    public $event_end_date;
    public $event_occurance;
    public $create_date;
    public $update_date;

	public function __construct(){
		parent::__construct();
        $this->load->database();
	}

    public function add_event($id=0){
        $this->event_name = $_POST['event_name'];
        $this->event_start_date = $_POST['event_start_date'];
        $this->event_repeat_number = $_POST['event_repeat_number'];
        $this->event_repeat_duration = $_POST['event_repeat_duration'];
        $this->event_end_type = $_POST['event_end_type'];
        $this->event_end_date = $_POST['event_end_date'];
        $this->event_occurance = $_POST['event_occurance'];
        $this->create_date = date('Y-m-d');
        $this->update_date = date('Y-m-d');

        if($id != 0){
            $this->db->update('event',$this, array('id' => $_POST['id']));
        }else{
            $this->db->insert('event',$this);
        }

    }


}
