<?php

if(!class_exists('Session_Cookies_Security')){
	
	class Session_Cookies_Security{
		
		
		/*************************
		* set header for security
		* session management
		************************/
		public function cookies_validate(){
			
			ini_set('session.cookie_httponly', true); 
			header( 'Expires: Thu, 26 Dec 2012 11:00:00 GMT' ); 
			header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
			header( 'Cache-Control: private' );  
			header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
			header( 'Cache-Control: post-check=0, pre-check=0', false ); 
			header( 'Pragma: no-cache' ); 

		}
		
		/*****
		* check ideal time of user of login user
		* if ideal time  not match user logout automatically
		* Ideal time manage with time
		* This ideal time work when user login our account
		***/
		public function set_ideal_login($args_session,$args_ideal_time,$ideal_time){
			
			if(isset($args_session))
			{
				if(!isset($args_ideal_time))
				{
					$cTime = time()+$ideal_time;
					$args_ideal_time = $cTime;
				}
				else
				{
					if(time() > $args_ideal_time)
					{
						return false;
					}
					else
					{
						$cTime = time()+$ideal_time;
						$args_ideal_time = $cTime;
						return $args_ideal_time;
					}
				}
			}
			else
				return false;
		}
		
		/*****
		* Generate randam unique session for make security
		* Session value change when new page upload
		***/
		public function regenerate_session($args_session,$args_fingerprint){
			
			//$_SESSION['fingerprint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
			if(isset($args_session))
			{
				if($args_fingerprint != md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']))
					return false;
				else
					return session_regenerate_id();
			}

		}
	}
}
?>
