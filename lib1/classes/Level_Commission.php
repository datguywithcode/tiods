<?php
/*
This class used for give level wise commission on product shopping
*/

if(!class_exists('Level_Commission')){
	
	class Level_Commission {
		
		private $product_id;
		private $invoice_no;
		private $total_amount;
		private $user_id;
		
		// use this function outside of class with two arguments
		public function give_point_upliner($user_id, $invoice,$product_id, $product_name, $total_amount){
			$this->invoice_no = $invoice;
			$this->product_id = $product_id;
			$this->total_amount =  $total_amount;
			$this->user_id = $user_id;
			$this->product_name = $product_name;
			
			return $this->give_point_commission();
		}
		
		// give commission to upliners
		private function give_point_commission(){
			
			// get database object
			global $mxDb;
			
			$cDate = date("Y-m-d");
			$cDateTime = date("Y-m-d H:i:s");
			
			// get level wise commission according product id
			$where = " where product_id='".$this->product_id."'";
			$args_levels = $mxDb->get_information('product_level_point','point, level', $where.' order by id asc', false, 'assoc');
			
			if($args_levels){
				
				// this loop execute whaterver level define by admin for particular product
				foreach($args_levels as $levels){
				
					// if commission set from 0 level then 0 level commission goes to self commission
					if( $levels['level'] == 0 ){
						
						// check user direct sponsor 
						$member_status = $mxDb->get_field_information('registration','mem_status',' where user_id='.$this->user_id, 'assoc');
						
							if( $member_status == 0 )
								$paid_status = $this->check_last_shopping($this->user_id);
							else
								$paid_status = 0;
								
							// add into level income
							$insert_level = array(
														'income_id'=>$this->user_id,
														'p_id'=>$this->product_id,
														'invoice_no'=>$this->invoice_no,
														'purcheser_id'=>$this->user_id,
														'level'=>$levels['level'],
														'commission'=>$levels['point'],
														'date'=>$cDate,
														'remark'=>'Get point from downline shopping',
														'invoice_amt'=>$this->total_amount,
														'paid_status'=>$paid_status
														);
														
							$mxDb->insert_record('level_income', $insert_level);	
							
							// if status is paid
							if( $paid_status == 1 ){
								
								// get total points 
								$where_user_ewallet = " where user_id='".$this->user_id."'";
								$total_points = $mxDb->get_field_information('final_e_wallet', 'amount', $where_user_ewallet, 'assoc');
								$total_points = $total_points+$levels['point'];
								
								// store record into transaction history
								$insert_credit_debit = array(
														'user_id'=>$this->user_id,
														'receiver_id'=>$this->user_id,
														'credit_amt'=>$levels['point'],
														'invoice_no'=>$this->invoice_no,
														'sender_id'=>$this->user_id,
														'receive_date'=>$cDate,
														'TranDescription'=>'Get point from downline shopping',
														'Remark'=>'Get point from downline shopping',
														'product_name'=>$this->product_name,
														'paid_status'=>$paid_status,
														'final_bal'=>$total_points
														);
														
								$mxDb->insert_record('credit_debit', $insert_credit_debit);
								
								// update total points into final E-wallet
								$condition = " user_id='".$this->user_id."'";
								$update_ewallet = array('amount'=>$total_points);
								$mxDb->update_record('final_e_wallet', $update_ewallet,$condition);
							}
						
					}
					
					else{
						
						// get upliner user commision
						$where_user = " where user_id='".$this->user_id."'";
						$args_user = $mxDb->get_information('registration','ref_id,mem_status', $where_user, true, 'assoc');
						
						
							// check user direct sponsor 
							if( $args_user['mem_status'] )
								$paid_status = $this->check_last_shopping($args_user['ref_id']);
							else
								$paid_status = 0;
								
							// add into level income
							$insert_level = array(
														'income_id'=>$args_user['ref_id'],
														'p_id'=>$this->product_id,
														'invoice_no'=>$this->invoice_no,
														'purcheser_id'=>$this->user_id,
														'level'=>$levels['level'],
														'commission'=>$levels['point'],
														'date'=>$cDate,
														'remark'=>'Get point from downline shopping',
														'invoice_amt'=>$this->total_amount,
														'paid_status'=>$paid_status
														);
														
							$mxDb->insert_record('level_income', $insert_level);	
							
							// if status is paid
							if( $paid_status == 1 ){
								
								// get total points 
								$where_user_ewallet = " where user_id='".$args_user['ref_id']."'";
								$total_points = $mxDb->get_field_information('final_e_wallet', 'amount', $where_user_ewallet, 'assoc');
								$total_points = $total_points+$levels['point'];
								
								// store record into transaction history
								$insert_credit_debit = array(
														'user_id'=>$args_user['ref_id'],
														'receiver_id'=>$args_user['ref_id'],
														'credit_amt'=>$levels['point'],
														'invoice_no'=>$this->invoice_no,
														'sender_id'=>$this->user_id,
														'receive_date'=>$cDate,
														'TranDescription'=>'Get point from downline shopping',
														'Remark'=>'Get point from downline shopping',
														'product_name'=>$this->product_name,
														'paid_status'=>$paid_status,
														'final_bal'=>$total_points
														);
														
								$mxDb->insert_record('credit_debit', $insert_credit_debit);
								
								// update total points into final E-wallet
								$condition = " user_id='".$args_user['ref_id']."'";
								$update_ewallet = array('amount'=>$total_points);
								$mxDb->update_record('final_e_wallet', $update_ewallet,$condition);
							
							}
							
							$this->user_id = $args_user['ref_id'];
					
						}
					// end loop level commission product wise
					}
				
			}
		}
		
		// check last month shopping
		private function check_last_shopping($user_id){
			
			// get database object
			global $mxDb;
			
			$cDate = date("Y-m-d");
			
			//$where_shopping = " where user_id='".$user_id."'";
			//$args_user_shopping = $mxDb->get_information('amount_detail','date', $where_shopping.' order by am_id desc', true, 'assoc');
			
			// get current month total shopping amount 
			// query (SELECT FORMAT( SUM( total_amount ) , 2 ) FROM amount_detail WHERE DATE >= NOW( ) - INTERVAL 1 MONTH )
			
			$where_shopping = " where user_id='".$user_id."' and DATE >= NOW( ) - INTERVAL 1 MONTH";
			$args_user_shopping = $mxDb->get_information('amount_detail','FORMAT( SUM( total_amount ) , 2 ) as total_amt', $where_shopping.' order by am_id desc', true, 'assoc');
			
			if(isset($args_user_shopping['total_amt'])){
				
				if( is_numeric($args_user_shopping['total_amt']) && $args_user_shopping['total_amt'] >= 120 ){
					
					return 1;
				}
				else
					return 0;
				
			}
			else
				return 0;
			
		}
		
	}
	
}
?>