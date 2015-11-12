<?php

require_once("data.php");


foreach($arr as $item){
    get_photo($item[0],$item[1].".png");
    //$file = file_get_contents($item[0]);
}

function get_photo($url,$filename='',$savefile='down/')   
{     
    $imgArr = array('gif','bmp','png','ico','jpg','jepg');  
  
    if(!$url) return false;  
    
    if(!$filename) {     
      $ext=strtolower(end(explode('.',$url)));     
      if(!in_array($ext,$imgArr)) return false;  
      $filename=date("dMYHis").'.'.$ext;     
    }     
  
    if(!is_dir($savefile)) mkdir($savefile, 0777);  
    if(!is_readable($savefile)) chmod($savefile, 0777);  
      
    $filename = $savefile.$filename;  
  
    ob_start();     
    readfile($url);     
    $img = ob_get_contents();     
    ob_end_clean();     
    $size = strlen($img);     
    
    $fp2=@fopen($filename, "a");     
    fwrite($fp2,$img);     
    fclose($fp2);     
    
    return $filename;     
 }    