<?php
$lang['title'] = "Мой Вкус";
$lang['description'] = "";
$lang['keywords'] = "";

//Форма регистрации
$lang['sign_up_message'] = "Регистрация нового пользователя";
$lang['sign_up_slogan_message'] = "Это займет у Вас не более 1 минуты"; 
$lang['first_name'] = "Имя:";
$lang['last_name'] = "Фамилия:";
$lang['password'] = "Пароль:";
$lang['email'] = "email:";
$lang['sign_up'] = "Регистрация";
$lang['captcha'] = "Код на картинке";

//Форма авторизации
$lang['log_in'] = "Войти";
$lang['forgot_password'] = "забыли пароль?";
$lang['checkbox_remember'] = "запомнить меня";



//Сообщение от валидаторов
$lang['Error_email'] = "Введенный email не корректный";
$lang['Error_firstname'] = "Длина имени должна быть не менее 4 символов";
$lang['Error_lastname'] = "Длина фамилии должна быть не менее 4 символов";
$lang['Error_password'] = "Пароль должен быть не менее 6 символов";
$lang['Error_captcha'] = "Код с картинки должен содержать 4 символа";
$lang['captcha_check'] = "<div class = \"Registraion_validator\" style=\"display:block;\">Код с картинки введен не верно! Попробуйте еще раз</div>";
$lang['email_check'] = "<div class = \"Registraion_validator\" style=\"display:block;\">Пользователь с таким email уже зарегестрирован!</div>";
 //Форма авторизации
$lang['check_user_mail_exist'] = "<div class = \"Registraion_validator\" style=\"display:block;\">Пользователя с таким email не существует!</div>";
$lang['check_password'] = "<div class = \"Registraion_validator\" style=\"display:block;\"> Указан неверный логин или пароль.</div>";


//Notification
$lang['AfterRegistraionEmailFrom'] = "support@moyvkus.ru";
$lang['AfterRegistraionEmailFromName'] = "Мой вкус - Поддержка";
$lang['AfterRegistraionEmailSubject'] = "Регистрация аккауна";
$lang['AfterRegistraionEmailMessage'] = "<html>
										<body>
										<p>Уважаемый(ая) {first_name} {last_name}</p>
										<p>Ваша учетная запись активирована</p>
										<p>Ваш пароль: {password}</p>
										<p>С уважением, администрация moyvkus.ru</p>
										</body>
										</html>";

?>