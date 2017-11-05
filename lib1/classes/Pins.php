<?php

Class Pins{
	
	public $no_of_pin;
	
	public function __construct(){
		$this->no_of_pin = 5;
	}
	
	
	public function give_pin_to_user($user_id, $created_by, $sender_by, $amount, $limit){
		
		global $mxDb;
		
		// get recever information.
		$condition = " where user_id='".$user_id."'";
		$args_receiver = $mxDb->get_information('user_registration', 'concat_ws(" ", first_name, last_name) as name, email, mobile', $condition, true, 'assoc');
		
		// check user get voucher or not
		$condition_user = " where receiver_id='".$user_id."'";
		$receiver_user = $mxDb->get_information('pins', 'receiver_id', $condition_user, true, 'assoc'); 
		
		if( !isset($receiver_user['receiver_id']) ){
		
			for($i=0; $i<$limit; $i++){
				
				$pin_no = $this->get_new_pin('pins');
				
				$insert_pin = array(
						
						'pin_no' => $pin_no,
						'amount' => $amount,
						'status' => 0,
						'crt_date' => date('Y-m-d'),
						'created_by_user' => $created_by,
						'receiver_id' => $user_id,
						'sender_id' => $sender_by,
						'name' => $args_receiver['name'],
						'email' => $args_receiver['email'],
						'mobile' => $args_receiver['mobile']
				);
				
				// insert record into pins
				$mxDb->insert_record('pins', $insert_pin);
				
			}
			
		}
		
	}
	
	public function get_new_pin($table){
		
		global $mxDb;
		
		$pin = $this->create_new_pin();
		
		$where = " where pin_no='".$pin."'";
		$args_pin = $mxDb->get_information($table, 'pin_no', $where, true, 'assoc');
		
		// check pin available or not
		if(isset($args_pin['pin_no'])){
			$this->get_new_pin($table);
		}
		else{
			return $pin;
		}
		
	}
	
	private function create_new_pin(){
		
		$chars = array("0", "1", "2", "3","4", "5", "6", "7", "8", "9");
		
		$rand_id="";
		
		for($j=1; $j<=10; $j++)
		
		{
		
			$num = mt_rand(0,9);
			
			$rand_id .= $chars[$num];
		
		}
		
		return $rand_id;
	}
	
	
}