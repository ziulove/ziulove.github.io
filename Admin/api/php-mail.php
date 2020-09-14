<?php 

	// be careful when you change the email subject and content, do not change or remove the variables, just change the text content
	// inaccuracies in changing or removing variables can cause errors

	// email order notification for administrator
	$to = $admin_email;
	$subject = "[ShopApp] Заказ от : ".$name. " - Код покупки : ".$code. " ";
	$message = "Привет Admin, <br><br>Вам поступил новый заказ: 
					<br><br>Имя : ".$name. "
					<br>Код : ".$code. "
					<br>Email : ".$email. "
					<br>Телефон : ".$phone. "
					<br>Адрес : ".$address. "
					<br>Доставка : ".$shipping. "
					<br>Дата : ".$date. "
					<br>Заказ : <br>".str_replace(',', '<br>', $order_list). "
					
					<br><br>Пожалуйста зайдите в админ панель и обработайте заказ :
					<br><a href=".$server_url.">ПЕРЕЙТИ</a>.

					<br><br>Erik Deliyev © 2019 ShopApp. All Rights Reserved. 
					";

	// email invoice detail for buyer
	$to2 = $email;
	$subject2 = "[ShopApp] Ваш закз : ".$name. " - Код покупки : ".$code. " ";
	$message2 = "Здравствуйте ".$name.", <br><br>Спасибо за заказ в нашем интернет-магазине: 
					<br><br>Имя : ".$name. "
					<br>Код : ".$code. "
					<br>Email : ".$email. "
					<br>Телефон : ".$phone. "
					<br>Адрес : ".$address. "
					<br>Доставка : ".$shipping. "
					<br>Дата : ".$date. "
					<br>Заказ : <br>".str_replace(',', '<br>', $order_list). "
					
					<br><br>Через некоторое время мы проверим наличие товаров и пришлём счёт для оплаты.
					
					<br><br>Оплатить Вы можете одним из способов: 
					<br>Сбербанк Онлайн : 356243425 25 2 523
					<br>Яндекс Деньги : 4635757
					<br>QIWI кошелёк : +7 874513 975413 
					<br>Webomey : R463557
					<br>Онлайн оплата на расчётный счёт

					<br><br>Если у вас возникнут вопросы по заказу или оплату, напишите нам :
					<br>".$admin_email. "

					<br><br>Erik Deliyev© 2019 ShopApp. All Rights Reserved. 
					";

	$headers = 'MIME-Version: 2.1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: ShopApp <erikdeliyev@gmail.com>' . "\r\n";

	//send email to administrator
	@mail($to, $subject, $message ,$headers);

	//send email to buyer
	@mail($to2, $subject2, $message2 ,$headers);

?>