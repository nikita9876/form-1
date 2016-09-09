<?php

		$to = 'nikitanikvta@gmail.com'; //!!! Вставить адрес заказчика

		$name = htmlspecialchars($_POST['name']);
		$tel = htmlspecialchars($_POST['tel']);
		$email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);


		if (empty($name) or empty($tel) or empty($email) or empty($message)) {
			echo "Не введено одно или несколько обязательных значений. Форма не будет отправлена. Если вы считаете, что произошла ошибка, пожалуйста, обратитесь к администратору ресурса.";
			exit();
		}

	require 'PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->CharSet = 'UTF-8';
	$mail->isHTML(true);
	$mail->setFrom('noreply@'.$_SERVER['HTTP_HOST'], 'СК-Ресурс'); // ПИСЬМО ОТ КОГО
	$mail->addAddress($to); // АДРЕС ЗАКАЗЧИКА
//	$mail->addBCC('drugoi@mail.ru');  // ДУБЛИРУЕМ АЛЕКСАНДРУ

	$mail->Subject = 'Новая заявка (СК-Ресурс)';
	$mail->Body    = '<!DOCTYPE html>
<html>
	<body>
		<h3>Была получена новая заявка с сайта СК-Ресурс</h3>
		<table style="width: 100%;" border=1 cellpadding=5>
			<tbody>
				<tr>
					<th>Имя</th>
					<td>'.$name.'</td>
				</tr>
				<tr>
					<th>Телефон</th>
					<td>'.$tel.'</td>
				</tr>
				<tr>
					<th>E-mail</th>
					<td>'.$email.'</td>
				</tr>
                <tr>
					<th>Сообщение</th>
					<td>'.$message.'</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<p>С наилучшими пожеланиями, <br><b>СК-Ресурс</b><br><br><a href="http://'.$_SERVER['HTTP_HOST'].'">'.$_SERVER['HTTP_HOST'].'</a></p>
	<div id="scrollup" style="display:block;"></div></body>
</html>';

	if(!$mail->send()) {
    	echo 'Ваше сообщение не принято по техническим причинам. Пожалуйста, свяжитесь с нами, это серьёзно.';
		echo 'Описание ошибки для технического отдела: ' . $mail->ErrorInfo;
	} else {
		echo '<html><head><meta charset="utf-8"></head><body><script>alert("Ваша заявка успешно принята! В ближайшее время с вами свяжется менеджер, чтобы уточнить детали. Спасибо!"); document.location.href="/";</script></body></html>';
	}

?>
