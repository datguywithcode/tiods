<?php

/*
This class work before insert record into database and fetch record into database
This class has image validation method, file validation method
This class has mysql injection flaws and xss injection flaws
*/

if(!class_exists('DB_action')){
	
		class DB_action extends Mysql{
			
			public $query;
			
			// establish connection when class object create
			public function __construct(){
			
				try{	
					// establish connection with database		
					$this->Connect(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
				}catch (Exception $e) {
					echo $e->getMessage();
				}
				
			}
			/*
			Get information from database
			Param first table name
			Param second is fields that values you want get
			Param third is condition by which you want to get record
			Param fourth is optional you want ot single record or multi reocrd (all according condition)
			Param fivth is which format you want to get record
			Return single or multi array
			*/
			public function get_information($table, $fields, $condition, $single=false, $record_format='array'){
				
				try{
					$table = TABLE_PREFIX.$table;
					$this->query = "select $fields from $table $condition";
					return $this->select($this->query ,$single, $record_format);
				}catch(Exception $e){
					$e->getMessage();
				}
			}
			
			/*
			Get information of single field from database
			Param first table name
			Param second is fields that values you want get
			Param third is condition by which you want to get record
			Param fourth is which format you want to get record
			Return single array
			*/
			public function get_field_information($table, $fields, $condition, $record_format='array', $echo=false){
				
				try{
					$table = TABLE_PREFIX.$table;
					$this->query = "select $fields from $table $condition";
					$record = $this->select($this->query ,true, $record_format);
					
					if($echo)
						echo $record[$fields];
					else
						return $record[$fields];
						
				}catch(Exception $e){
					$e->getMessage();
				}
				
			}
			
			/*
			insert record into table
			Param first is table name 
			Param second is array of insert values and fields (put field name as key in array and value inti value of that field as value)
			*/
			public function insert_record($table, $insert_array){
				
				try{
					if(is_array($insert_array)){
						foreach($insert_array as $key=>$val){
							
							$val = $this->check_mysql_injection_flaws($val);
							$insert_array[$key] = $this->check_xss_injection_flaws($val);
						}
					}
					else{
						echo "second argument not array. Please send array. Key as field name and value is value of field";
						exit;
					}
						
					$table = TABLE_PREFIX.$table;
					return $this->insert($table, $insert_array);
					
				}catch(Exception $e){
					$e->getMessage();
				}
				
			}
			
			/*
			update record into table
			Param first is table name 
			Param second is array of insert values and fields (put field name as key in array and value inti value of that field as value)
			Param third is condition by which you want to update record
			*/
			public function update_record($table, $update_array,$condition){
				
				try{
					if(is_array($update_array)){
						foreach($update_array as $key=>$val){
							
							$val = $this->check_mysql_injection_flaws($val);
							$insert_array[$key] = $this->check_xss_injection_flaws($val);
						}
					}
					else{
						echo "second argument not array. Please send array. Key as field name and value is value of field";
						exit;
					}
					
					$table = TABLE_PREFIX.$table;
					return  $this->update($table, $update_array, $condition);
				
				}catch(Exception $e){
					$e->getMessage();
				}
				
			}
			
			/*
			delete record from table
			Param first is table name 
			Param second is condition by which you want to delete record
			*/
			public function delete_record($table, $condition){
				
				try{
					$table = TABLE_PREFIX.$table;
					return $this->delete($table, $condition);
				
				}catch(Exception $e){
					$e->getMessage();
				}
				
			}
			
			/*
			This method check mysql injections 
			Param first is value check mysql injection flaws before insert record
			Return value remove if any injection flaws in this value
			*/
			public function check_mysql_injection_flaws($value){
				
				$blacklist = array('and ','or ','not ','join ','inner join','left join','right join', 'outer join', 'full outer join','<>','=','like');
				
				foreach($blacklist as $list)
				{
					$req_field = preg_replace('/'.$list.'/','',$value);
					$req_field= trim($req_field);
					
					$value = $value;
				}			
			
				return $value;
			}
			
			/*
			This method check xss injections 
			Param first is value check mysql injection flaws before insert record
			Return value remove if any injection flaws in this value
			*/
			public function check_xss_injection_flaws($value){
				
				$eventlist = array('onclick','ondblclick','onmousedown','onmousemove','onmouseout','onmouseover','onmouseup','onkeyup','onkeypress','onkeydown','onsubmit','onselect','onblur','onchange','onunload','onload','onerror','alert','document.write');
	
				$value = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $value);
					
				foreach($eventlist as $events)
				{
					$value = preg_replace('/'.$events.'/', "", $value);
				}
							
				return $value;
			}
			
			/*
			This method check image validation
			Param first is file name
			Param second is file path
			return boolen value
			*/
			public function image_validation($filename,$filepath){
				
			   $flag = 0;	
			   
			   $blacklist = array(".php", ".phtml", ".php3", ".php4", ".php5", ".asp", ".aspx", ".pl");
		
				foreach ($blacklist as $item)
				{
					if(preg_match("/$item\$/i", $filename)) 
					{
						echo "We do not allow uploading PHP files\n";
						exit; 
					} 
				}
				$imageinfo = @getimagesize($filepath); //check image size
				if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') 
				{
					echo "Sorry, we only accept GIF and JPEG/JPG images and PNG\n";
					exit;
				}
				else
				{
					$flag = 1;	
				}
				
				return $flag;	
			}
			
			/*
			This method check file validation
			Param first is file path
			return boolen value
			*/
			public function file_validation($filepath){
				
				$flag = 0;	
			  
				$fp = fopen($filepath, 'r');
				
				// move to the 0th byte
				fseek($fp, 0);
				$data = fread($fp, 5);   // read 5 bytes from byte 0
				
				if(strcmp($data,"%DOC-")==0 || strcmp($data,"%XLS-")==0 || strcmp($data,"%PPT-")==0 || strcmp($data,"%PDF-")==0)
				{
					$flag = 1;
				}
				else
				{
					echo "Sorry, we only accept correct doc, pdf, ppt and xls file \n";
					exit;
				} 
				
				fclose($fp);
				
				return $flag;	
			}
			
		public function host_name(){
			  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
			  
			  if ($_SERVER["SERVER_PORT"] != "80") {
			   $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
			  } 
			  else{
			   $pageURL .= $_SERVER["SERVER_NAME"].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
			  }
			  return $pageURL;
			  
		 }		
	}
}

?>
