<?php 
	require __DIR__ . '/vendor/autoload.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


	define('SITE_URL','tgtlkw.com');
	define('GMAIL_ADDR','transgulf@gmail.com');
	define('GMAIL_PWD','');


	$mail = new PHPMailer(true);
	$adminFromAddress = GMAIL_ADDR;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	$mail->Username   = $adminFromAddress;                     // SMTP username
	$mail->Password   = GMAIL_PWD;                               // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mail->Port       = 587;      


	$mail->setFrom($adminFromAddress, 'Medship.in Admin');
    $mail->addAddress('shameelsadaka@gmail.com', 'Shameel K');

 	$mail->isHTML(true);



    
 	function generateMailBody($params){
 		$html = "Email from tgtlkw.com<br/><br/>";
 		$html .= "<table border=\"1\" cellpadding=\"8\" cellspacing=\"1\" width=\"100%\">";
		foreach ($params as $key => $value) {
			$html .= "  <tr align='left'>";
			$html .= "  <th width=\"30%\">".$key."</th>";
			$html .= "  <td>".$value."</td>";
			$html .= "  </tr>";
		}
		$html .= "</table>";
 		return $html;
 	}	


?>	