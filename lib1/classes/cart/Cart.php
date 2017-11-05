<?php
if(!class_exists('Cart')){
	
	class Cart{
		
		public $total_product;
		public $total_qty;
		public $total_price;
		public $shipping;
		public $tax;
		public $grand_total;
		
		public function add_product_cart($product_id,$qty,$price){
			
			if(!isset($_SESSION['shopping_cart'])){
				$_SESSION['shopping_cart'] = session_id();
				$_SESSION['cart_product'][$product_id] = $product_id;
				$_SESSION['cart_qty'][$product_id] = $qty;
				$_SESSION['cart_price'][$product_id] = $price;
				return true;
			}
			else{
				
				if(!array_key_exists($product_id,$_SESSION['cart_product'])){
					$_SESSION['cart_product'][$product_id] = $product_id;
					$_SESSION['cart_qty'][$product_id] = $qty;
					$_SESSION['cart_price'][$product_id] = $price;
					return true;
				}
				else
					return false;				
				
			}
			
		}
		
		public function update_product_cart($product_id,$qty,$price){
		
			if(array_key_exists($product_id,$_SESSION['cart_product'])){
				$_SESSION['cart_qty'][$product_id] = $qty;
				return true;
			}
			else
				return false;
		}		
	
		public function delete_product_cart($product_id){
			
			if(array_key_exists($product_id,$_SESSION['cart_product'])){
				unset($_SESSION['cart_product'][$product_id]);
				unset($_SESSION['cart_qty'][$product_id]);
				unset($_SESSION['cart_price'][$product_id]);
				
				if(count($_SESSION['cart_product']) == 0)
					unset($_SESSION['shopping_cart']);
				
				return true;
			}
			else
				return false;	
		}
	}
}
?>