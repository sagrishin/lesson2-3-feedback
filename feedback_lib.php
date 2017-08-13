<?php

	$email = $_POST["email"];
	$message = $_POST["message"];
	$result = 0;
	define(EMAIL_TO, "email@lessons.local");
	
	if ((strlen($email) < 5) or (strlen($message) < 10)) $result = 1; // длинна сообщения
	else {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$subject = "Письмо с Вашего сайта http://".$_SERVER["HTTP_HOST"]."/";
			$header = "From <".$email.">\r\nContent-type: text/plain; charset=utf-8\r\n";
			mail(EMAIL_TO, $subject, $message, $header);
			$result = 3; //письмо отправлено
		}
		else $result = 2; // неправильный email
	}
	echo getAnswer($result);
	
	function getAnswer($result) {
		switch ($result) {
			case 0: return "";
			case 1: return "<p style='color: red;'>Минимальная длинна собщения 10 символов, а email - 5!</p>";
			case 2: return "<p style='color: red;'>Неправильный email! Проверьте.</p>";
			case 3: return "<p style='color: green;'>Письмо отправлено.</p>";
		}
	}
	
?>