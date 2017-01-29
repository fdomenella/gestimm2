<?PHP 

class Image{ 

    var $src_filename; 

    var $src_witdh; 

    var $src_height; 

    var $src_type; 

    var $src_attr; 

    var $src_image;   
	var $dim;


    function Image($filename){ 

        $this->src_filename = $filename; 

        $this->GetImageInfo(); 

    } 



    function GetImageInfo(){ 

        list($this->src_width, $this->src_height, $this->src_type, $this->src_attr) = getimagesize($this->src_filename);
        $dim = getimagesize($this->src_filename);
		
    } 



    function CreateSourceImage(){ 

        switch($this->src_type){ 

            case 1: 

                $this->src_image =imagecreatefromgif($this->src_filename); 

                   break; 

            case 2: 

                $this->src_image =imagecreatefromjpeg($this->src_filename); 

            break; 

            case 3: 

                $this->src_image =imagecreatefrompng($this->src_filename); 

            break; 

            default:    return false; 

        } 



        return true; 

    } 


    function SaveProportionateImage($filename, $quality, $lato_maggiore){ 
		
    	
    	$dim = getimagesize($this->src_filename);
		$h= $dim[1];
		$w = $dim[0];
		
		if ($lato_maggiore=="auto") {
			if($h>$w){
					
	        	$dest_height = $h;
				
		        $ratio = $h / $dest_height; 
		        $xg=$w/$ratio;
	        	$yg=$dest_height;
	        	
		        $dest_image = imagecreatetruecolor( $xg, $dest_height); 
	
				
	
		       imagecopyresampled($dest_image, $this->src_image, 0, 0, 0, 0, 
	
	            $xg, 
	
	            $yg, 
	
	            $w, 
	
	            $this->src_height);  
		
	            imagejpeg($dest_image, $filename, $quality); 
	            
		       imagedestroy($dest_image); 
			}else {
				$dest_width = $w; 
    		
    		
      		 $ratio = $w / $dest_width; 
			
      		 $dest_image = imagecreatetruecolor($dest_width, $this->src_height / $ratio); 
      
		
        	$xg=$dest_width;
        	$yg=$this->src_height/$ratio;

     	
       		 imagecopyresampled($dest_image, $this->src_image, 0, 0, 0, 0, 

            $xg, 

            $yg, 

            $w, 

            $this->src_height); 
            
		imagejpeg($dest_image, $filename, $quality); 

        imagedestroy($dest_image); 
			}
			
		}

        elseif($h>$w){
        	//l'immagine è in prevalenza verticale

			//echo "xxx";
			//echo $h; echo $w;exit;
        	$dest_height = $lato_maggiore; 
			
	        $ratio = $h / $dest_height; 
	        $xg=$w/$ratio;
        	$yg=$dest_height;
        	
	        $dest_image = imagecreatetruecolor( $xg, $dest_height); 

			

	       imagecopyresampled($dest_image, $this->src_image, 0, 0, 0, 0, 

            $xg, 

            $yg, 

            $w, 

            $this->src_height);  
	
            imagejpeg($dest_image, $filename, $quality); 
            
	       imagedestroy($dest_image); 

        }
    	else{
			
    		$dest_width = $lato_maggiore; 
    		
    		
      		 $ratio = $w / $dest_width; 
			
      		 $dest_image = imagecreatetruecolor($dest_width, $this->src_height / $ratio); 
      
		
        	$xg=$dest_width;
        	$yg=$this->src_height/$ratio;

     	
       		 imagecopyresampled($dest_image, $this->src_image, 0, 0, 0, 0, 

            $xg, 

            $yg, 

            $w, 

            $this->src_height); 
            
		imagejpeg($dest_image, $filename, $quality); 

        imagedestroy($dest_image); 
    	}
    	
    } 
 
  
    function Free(){ 

        imagedestroy($this->src_image); 

    } 

} 
?>