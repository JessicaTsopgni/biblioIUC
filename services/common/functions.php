<?php
    
    //$upload_file_name === $FILES['<field_name>']['name']
    function get_new_upload_file_name($upload_file_name, $file_name_prefix)
    {
        if (!empty($upload_file_name))
        {
            $path = pathinfo($upload_file_name);
            $ext = '.'.$path['extension'];
            $filename = $file_name_prefix.uniqid().$ext;
            return $filename;
        }
        return null;
    }

     //$upload_file_tmp_name === $FILES['<field_name>']['tmp_name']
     function image_resize($upload_file_tmp_name, $size, $destination, $maxisheight = 0 )
    {
        $gis           = getimagesize($upload_file_tmp_name);
        $type          = $gis[2];
        switch($type)
        {
            case "1": $imorig = imagecreatefromgif($upload_file_tmp_name); break;
            case "2": $imorig = imagecreatefromjpeg($upload_file_tmp_name);break;
            case "3": $imorig = imagecreatefrompng($upload_file_tmp_name); break;
            default:  $imorig = imagecreatefromjpeg($upload_file_tmp_name);
        }

        $x = imagesx($imorig);
        $y = imagesy($imorig);
    
        $woh = (!$maxisheight)? $gis[0] : $gis[1] ;   
    
        if($woh <= $size)
        {
            $aw = $x;
            $ah = $y;
        }
        else
        {
            if(!$maxisheight)
            {
                $aw = $size;
                $ah = $size * $y / $x;
            } 
            else 
            {
                $aw = $size * $x / $y;
                $ah = $size;
            }
        }  
        $im = imagecreatetruecolor($aw,$ah);
        if (imagecopyresampled($im,$imorig , 0,0,0,0,$aw,$ah,$x,$y))
            if (imagejpeg($im, $destination))
                return true;
            else
                return false;
    }

     //$upload_file_tmp_name === $FILES['<field_name>']['tmp_name']
    function check_file_type($upload_file_tmp_name, $allowed_types)
    {
        if($upload_file_tmp_name == null)
            return false;
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detected_type = finfo_file($fileInfo, $upload_file_tmp_name);
        finfo_close($fileInfo);
        return in_array($detected_type, $allowed_types);
    }
?>