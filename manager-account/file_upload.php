<?php

error_reporting(0);
		


function file_upload($datafile)
{

	#----------------------------------------------------------
	$element_name = $datafile['element_name'];
	$upload_folder_location = $datafile['upload_folder_location'];
	#----------------------------------------------------------

	$targetFile = $upload_folder_location .basename($_FILES[$element_name]["name"]);
  
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
  
  $new_name=strval(rand())."_file_upload_".strval(time()).".".strval($imageFileType);
  
  $targetFile = $upload_folder_location.$new_name;
  

  if(move_uploaded_file($_FILES[$element_name]["tmp_name"], $targetFile)){
    return $new_name;
  } else {
    return -1;
  }

}



