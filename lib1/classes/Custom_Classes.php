<?php
// custom function 
if(!class_exists('Custom_Classes')){
	class Custom_Classes{
		
		public function get_options($args_array, $key, $value, $select_val,$echo=false){
			
			if(isset($args_array)){
				
				$options = '';
				foreach($args_array as $option){
					$selected = ($option[$key] == $select_val)? 'selected' : '';
					$options .= '<option value="'.$option[$key].'" '.$selected.'>'.$option[$value].'</option>';
				}
				
				if($echo)
					echo $options;
				else
					return $options;
			}
			
		}
		
		public function get_product_with_catgories($table,$category_id){
			
			// get db action object
			global $mxDb;

			$args_product_list = array();
			$args_products = array();
			
			// get main category list product
			if( $table == "categories" ){
								
				// get main category list product
				
				$args_products[] = $category_id;
				
				// get sub category list product
				$condition = "where category_id in(select sub_category_id from sub_categories where category_id='".$category_id."')";
				$category_list_second = $mxDb->get_information('sub_categories', 'sub_category_id', 'order by position asc',false, 'assoc');
				
				if($category_list_second){
					foreach($category_list_second as $list_first)
						$args_products[] = $list_first['sub_category_id'];
				}
					
				// get sub sub category list product
				$condition = "where category_id in(select sub_sub_category_id from sub_sub_categories where sub_category_id in(select sub_category_id from sub_categories where category_id='".$category_id."'))";
				$category_list_third = $mxDb->get_information('sub_sub_categories', 'sub_sub_category_id', 'order by position asc',false, 'assoc');
					
				if($category_list_third){
					foreach($category_list_third as $list_first)
						$args_products[] = $list_first['sub_sub_category_id'];
				}
				
				if(!empty($args_products[0])){
					
					$args_products = array_unique($args_products);
					$categories = implode("','",$args_products);
					
						
					// get sub sub category list product
					$condition = "where category_id in('".$categories ."')";
					$product_list = $mxDb->get_information('products', '*', 'order by product_id desc',false, 'assoc');
					
					if($product_list)
						$args_product_list = $product_list;	
				
				}
			}
			// get sub category list product
			elseif( $table == "sub_categories" ){
				
				// get sub category list product
				$condition = "where category_id in(select sub_category_id from sub_categories where category_id='".$category_id."')";
				$category_list_second = $mxDb->get_information('sub_categories', 'sub_category_id', 'order by position asc',false, 'assoc');
				
				if($category_list_second){
					foreach($category_list_second as $list_first)
						$args_products[] = $list_first['sub_category_id'];
				}
					
				// get sub sub category list product
				$condition = "where category_id in(select sub_sub_category_id from sub_sub_categories where sub_category_id in(select sub_category_id from sub_categories where category_id='".$category_id."'))";
				$category_list_third = $mxDb->get_information('sub_sub_categories', 'sub_sub_category_id', 'order by position asc',false, 'assoc');
					
				if($category_list_third){
					foreach($category_list_third as $list_first)
						$args_products[] = $list_first['sub_sub_category_id'];
				}
				
				if(!empty($args_products[0])){
					
					$args_products = array_unique($args_products);
					$categories = implode("','",$args_products);
					
						
					// get sub sub category list product
					$condition = "where category_id in('".$categories ."')";
					$product_list = $mxDb->get_information('products', '*', 'order by product_id desc',false, 'assoc');
					
					if($product_list)
						$args_product_list = $product_list;	
				
				}		
					
			}
			// get sub category list product
			elseif( $table == "sub_sub_categories" ){
				
				// get sub sub category list product
				$condition = "where category_id in(select sub_sub_category_id from sub_sub_categories where sub_category_id in(select sub_category_id from sub_categories where category_id='".$category_id."'))";
				$category_list_third = $mxDb->get_information('sub_sub_categories', 'sub_sub_category_id', 'order by position asc',false, 'assoc');
					
				if($category_list_third){
					foreach($category_list_third as $list_first)
						$args_products[] = $list_first['sub_sub_category_id'];
				}
				
				if(!empty($args_products[0])){
					
					$args_products = array_unique($args_products);
					$categories = implode("','",$args_products);
					
						
					// get sub sub category list product
					$condition = "where category_id in('".$categories ."')";
					$product_list = $mxDb->get_information('products', '*', 'order by product_id desc',false, 'assoc');
					
					if($product_list)
						$args_product_list = $product_list;	
				
				}		
					
			}
			
			return $args_product_list;
			
		}
	}
}
?>