<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email {
	
	public static function send_email($subject, $message, $attachment_file='', $send_to_email='') {
		require_once(APPPATH.'third_party/PHPMailer/PHPMailerAutoload.php');
		$ci = &get_instance();
		$ci->config->load('my_email');
		
		$mail = new PHPMailer();
		$mail->CharSet = 'utf-8';
		$mail->isSMTP();
		$mail->Host = $ci->config->item('smtp_host');
		$mail->Port = $ci->config->item('smtp_port');
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = $ci->config->item('smtp_secure');
		$mail->Username = $ci->config->item('smtp_user');
		$mail->Password = $ci->config->item('smtp_pass');
		
		$mail->From = $ci->config->item('smtp_user');
		$mail->FromName = $ci->config->item('from_name');
		if(!empty($attachment_file))
			$mail->addAttachment($attachment_file);

		$mail->addAddress($send_to_email);
		$mail->Subject = $subject;
		$mail->IsHTML(true);
		$mail->Body = $message;
		$mail->AltBody = "text/html";
		
		if(!$mail->send()) {
			log_message('error', $mail->ErrorInfo);
			return "false";
		}
		return 'true';
	}
	
	public static function send_email_table($subject, $item_descs, $items, $title='', $full_file_name='') {
		if(empty($item_descs))
			return 'no items_desc';
		
		//按照$item_descs规定顺序输出
		$message_string = "<table border='1'><tr bgcolor='#87CEEB'>";
		$message_string = empty($title)?$message_string:"<p>".$title."</p>".$message_string;
		foreach($item_descs as $k => $v){
			$message_string .= "<th>$v</th>";
		}
			$message_string .= "</tr>";
		
		foreach ($items as $key => $item) {
			$message_string .= "<tr>";
			foreach (array_keys($item_descs) as $index) {
				$column_vlaue = isset($item[$index]) ? $item[$index] : '';
				$message_string .= "<td>$column_vlaue</td>";
			}
			$message_string .= "</tr>";
		}
		$message_string .= "</table>";
		if(!empty($full_file_name))
			MY_File::create_file($full_file_name, $message_string);
		self::send_email($subject, $message_string, $full_file_name);
	}
	
	public static function test(){
		echo __FILE__;
	}
}
