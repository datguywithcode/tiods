<?php
/*
Show downline members list 
This class show downline of Maxtrix paln and Unilevel plan
*/
if(!class_exists('showDwonMem')){
	
	class showDwonMem{
		
		// this method use for maxtrix plan
		public function shoDwnMemWithNom($dwnid,$tid)
		{
			global $data_dwn, $lel, $le, $mxDb;
			
			$condition=" where nom_id='$dwnid' order by id desc";
			$args_user = $mxDb->get_information('registration', 'user_id', $condition, true, 'assoc');
			
			if( isset($args_user['user_id']) )
			{
				$user2=$args_user['user_id'];
				$data_dwn = $this->showMemXNom($user2,$tid);
			}
			return $data_dwn;
		}
		// this method use for Matrix plan downlines get 
		private function showMemXNom($dwnid,$tid)
			{
				global $data_dwn,$lel,$le, $mxDb;
				
				$condition=" where nom_id='$dwnid' order by id desc";
				$args_user = $mxDb->get_information('registration', 'user_id', $condition, false, 'assoc');
				//$le=2;
				
				if( $args_user )
				{
					foreach( $args_user as $user )
					{
							$user_id=$user['user_id'];
							$data_dwn[]=$user;
						//	$levv=level_count($idx,$tid);
							$lel[]=$le;
							++$le;
							//print $data_dwn;
							$this->showMemXNom($user_id,$tid);
					}
				}
				
				return $data_dwn;
			}
			
			// this method use for unilevel plan
			
			public function shoDwnMemWithRef($dwnid,$tid)
			{
				global $data_dwn, $lel, $le, $mxDb;
				
				$condition=" where ref_id='$dwnid' order by id desc";
				$args_user = $mxDb->get_information('registration', 'user_id', $condition, true, 'assoc');
				
				if( isset($args_user['user_id']) )
				{
					$user2=$args_user['user_id'];
					$data_dwn = $this->showMemXRef($user2,$tid);
				}
				return $data_dwn;
			}
			// this method use for unilevel plan downlines get 
			private function showMemXRef($dwnid,$tid)
				{
					global $data_dwn,$lel,$le, $mxDb;
					
					$condition=" where ref_id='$dwnid' order by id desc";
					$args_user = $mxDb->get_information('registration', 'user_id', $condition, false, 'assoc');
					//$le=2;
					
					if( $args_user )
					{
						foreach( $args_user as $user )
						{
								$user_id=$user['user_id'];
								$data_dwn[]=$user;
							//	$levv=level_count($idx,$tid);
								++$le;
								$lel[]=$le;
								
								//print $data_dwn;
								$this->showMemXRef($user_id,$tid);
						}
					}
					
					return array($data_dwn,$lel);
				}
	}
}
?>