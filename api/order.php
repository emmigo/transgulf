<?php
	include "config.php";
	/*
		@Required
		name
		email
		contact
		to_address
		img (Prescription Image)
	
		@Optional
		from_address
		prescription_text
	*/
	if(isset(
		$_POST['name'],
		$_POST['email'],
		$_POST['contact'],
		$_POST['message']
	)){
		$upload = new \Delight\FileUpload\FileUpload();
		$upload->withTargetDirectory('uploads');
		$upload->withAllowedExtensions([ 'jpeg', 'jpg', 'png', 'pdf' ]);
		$upload->from('img');
		try {
		$uploadedFile = $upload->save();
		$filename = $uploadedFile->getFilenameWithExtension();
			$mail->Subject = 'New Message from Website';
			$params = Array();
			$params['Name'] = $_POST['name'];
			$params['Email'] = $_POST['email'];
			$params['Contact'] = $_POST['contact'];
			$params['Message'] = nl2br($_POST['message']);
		$mail->Body = generateMailBody($params);
			try{
			$mail->send();
			die(json_encode(["errors"=>0,"message"=>"Order submitted succesfully! We will contact you soon."]));
		}
		catch(Exception $e){
					die(json_encode(["errors"=>1,"message"=>"Could't send mail","error_detail"=>$e->getMessage()]));
		}
		}
		catch(Exception $e){
			die(json_encode(["errors"=>1,"message"=>"Some error occured"]));
		}
	}
	else{
		die(json_encode(["errors"=>2,"message"=>"Some required fields are not sent"]));
	}
	
?>