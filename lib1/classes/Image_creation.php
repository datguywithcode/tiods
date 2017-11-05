<?php
// custom function 
if(!class_exists('Image_creation')){
	class Image_creation{
		
		public $main_image_name = '';
		public $main_image_path = '';
		public $new_image_name = '';
		public $new_image_path = '';
		public $new_image_width = '';
		public $new_image_height = '';
		public $ext = '';
		
		public function image_create(){
			
			$imglocation = $this->main_image_path.$this->main_image_name;
			
			// check file exists or not
			if(file_exists($imglocation))
			{
				// get image by which new image will create with jpeg or jpg format
				if(strtolower($this->ext) == "jpg" || strtolower($this->ext) == "jpeg")
					$img = imagecreatefromjpeg($imglocation);
				
				// get image by which new image will create with png format
				if(strtolower($this->ext) == "png")
					$img = imagecreatefrompng($imglocation);
					
				// get image by which new image will create with gif format
				if(strtolower($this->ext) == "gif")
					$img = imagecreatefromgif($imglocation);
				
				// init new image hight and width of image
				$new_width = $this->new_image_width;
				$new_height =  $this->new_image_height;
				
				list($width,$height)=getimagesize($imglocation);
				
				// check new image width greater than original image then assign original image width
				if($width>$this->new_image_width)
					 $new_width=$this->new_image_width;
				else
					 $new_width=$width;
				
				// check new image height greater than original image then assign original image height
				if($height>$this->new_image_height)
					 $new_height=$this->new_image_height;
				else
					 $new_height=$height;
				
					
				$tmp_img = imagecreatetruecolor( $new_width, $new_height );
				imagealphablending($tmp_img, false);
				imagesavealpha($tmp_img,true);
				$transparent = imagecolorallocatealpha($tmp_img, 255, 255, 255, 127);
				imagefilledrectangle($tmp_img, 0, 0, $new_width, $new_height, $transparent);
					
				//imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
				imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				
				// save image name
				$imagename = $this->new_image_path.$this->new_image_name;
				
				if(!empty($imagename)){
					// store image if extention is jpg or jpeg
					if(strtolower($this->ext) == "jpg" || strtolower($this->ext) == "jpeg")
						imagejpeg( $tmp_img, $imagename, 100 );
					
					// store image if extention is png
					if(strtolower($this->ext) == "png")
						imagepng( $tmp_img, $imagename, 9 );
						
					// store image if extention is png
					if(strtolower($this->ext) == "gif")
						imagegif( $tmp_img, $imagename);
						
					return true;
				}
				else{
					echo "new image file path and name not correct";
					exit;
				}
			}
			else{
				echo "file doesn't exits. Please check file path and file name";
				exit;
			}
				
		}

		
	}
}
?>