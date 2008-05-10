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
$lang['repassword'] = "Пароль еще раз:";
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
$lang['Error_repassword'] = "Введенные пароли не совпадают";
$lang['Error_captcha'] = "Код с картинки должен содержать 4 символа";
$lang['captcha_check'] = "<div class = \"Registraion_validator\" style=\"display:block;\">Код с картинки введен не верно! Попробуйте еще раз</div>";
$lang['email_check'] = "<div class = \"Registraion_validator\" style=\"display:block;\">Пользователь с таким email уже зарегестрирован!</div>";
 //Форма авторизации
$lang['check_user_mail_exist'] = "<div class = \"Registraion_validator MessageWide\" style=\"display:block;\">Пользователя с таким email не существует!</div>";
$lang['check_password'] = "<div class = \"Registraion_validator\" style=\"display:block;\">Указан неверный логин или пароль.</div>";


//Notification
$lang['AfterRegistraionEmailFrom'] = "support@moyvkus.ru";
$lang['AfterRegistraionEmailFromName'] = "Мой вкус - Поддержка";
$lang['AfterRegistraionEmailSubject'] = "Регистрация аккауна";
$lang['AfterRegistraionEmailMessage'] = "<html>
										<body>
										<p>Уважаемый(ая) {first_name} {last_name}</p>
										<p>Ваша учетная запись активирована</p>
										<p>Ваш пароль: {password}</p>
								<p>С уважаением администарация проекта Мой Вкус.ru <a href=\"http://www.moyvkus.ru\">http://www.moyvkus.ru</a></p>
		</body>
										</html>";
										
$lang['InviteEmailSubject'] = "Приглашаем вас зарегистрироваться в нашем проекте Мой Вкус.ru http://www.moyvkus.ru";
$lang['InviteEmailMessage'] = "<html>
								<body>
								<p>Уважаемый {InvetedUserFullName}</p>
								<br/>
								<p>Пользователь сети Мой Вкус.ru(http://www.moyvkus.ru), 
								{UserFullName} желает вас пригласить и принять участие в проекте, который просвещенный вкусным блюдам.</p>
								<br/>
								<p>Для начала регистрации пройдите по этой ссылке {UrlForRegister}</p>
								<br/>
								<p>Если вы не хотите участвовать в проекте или вы не знакомы с данным пользователем, просто удалите это письмо.</p>
								<br/>
								<p>С уважаением администарация проекта Мой Вкус.ru <a href=\"http://www.moyvkus.ru\">http://www.moyvkus.ru</a></p>
								</body>
								</html>";

										
//Profile
$lang['Prifile'] = "Профайл";
$lang['Edit'] = "Редактировать";
$lang['Avatar'] = "Аватар";
$lang['MyFriendsHeader'] = "Функции";
$lang['MyData'] = "Личная информация";
$lang['FirstNameText'] = "Имя:";
$lang['LastNameText'] = "Фамилия:";
$lang['SexText'] = "Пол:";
$lang['BirthdayText'] = "День рождения:";
$lang['LoctionText'] = "Местоположение:";
$lang['WebSiteText'] = "Веб-сайт:";
$lang['InstantMessagerText'] = "Телефон:";
$lang['ActivitiesText'] = "Деятельность:";
$lang['InterestsText'] = "Интересы:";
$lang['AboutText'] = "О себе:";
$lang['MyRatingText'] = "Мой рейтинг:";
$lang['MyRatingLevelText'] = "Уровень:";
$lang['MyBestRecipesText'] = "Лучший рецепт:";
$lang['MyRecipes'] = "Мои рецепты";
$lang['MyInfo'] = "О себе";
$lang['Contacts'] = "Контактная информация";
$lang['MyRatingTextHeader'] = "Рейтинги";
$lang['Man'] = "Мужской";
$lang['Woman'] = "Женский";
$lang['AddToFriends'] = "Добавить в друзья";
$lang['DeleteFromFriends'] = "Убрать из друзей";
$lang['Friends'] = "Просмотреть друзей";

//Edit profile
$lang['EditProfile'] = "Редактирование профайла";
$lang['LoginInformation'] = "Регистрационная информация";
$lang['NewEmailText'] = "E-mail:";
$lang['OldPasswordText'] = "Старый пароль:";
$lang['NewPassword'] = "Новый пароль:";
$lang['ReNewPassword'] = "Повтор нового пароля:";
$lang['SaveAllChanges'] = "Сохранить все изменения?";
$lang['Save'] = "Сохранить";
$lang['Upload'] = "Загрузить";
$lang['Day'] = "День";
$lang['Month'] = "Месяц";
$lang['Year'] = "Год";
$lang['Country'] = "Страна";
$lang['City'] = "Город";
$lang['MySettings'] = "Мои настройки";
$lang['Cancel'] = "Отмена";
$lang['Region'] = "Регион";
$lang['txtNewPassword'] = "Пароль должен быть не менее 6 символов";

//My friends
$lang['MyFriends'] = "Мои друзья";
$lang['FriendsFilter'] = "Фильтр друзей";
$lang['Search'] = "Поиск";
$lang['MyFriendsCount'] = "У Вас {Number} друзей";
$lang['MyFriendsCountNew'] = "У Вас {Number} друзей <span style=\"color:red;\"> + {NewFriendsNumber} новых</span>";

$lang['SendMessage'] = "Отправить сообщение";
$lang['FriendFriends'] = "Его(ее) друзья";
$lang['DeleteFriend'] = "Убрать из друзей";

//MessageBox
$lang['MessageBoxTitleFriendDelete'] = "Убрать из друзей";
$lang['MessageBoxTitle'] = "Удаление из списка друзей";
$lang['MessageBoxText'] = 'Вы точно хотите удалить участника(цу) <a href="{FriendUrl}">{FriendFullName}</a> из списка друзей?';

$lang['MessageBoxTextAddFriend'] = 'Вы точно хотите добавить участника(цу) <a href="{FriendUrl}">{FriendFullName}</a> в список ваших друзей?';

$lang['Yes'] = "Удалить";
$lang['No'] = "Отмена";
$lang['SpamWarning'] = "Вы не можете отправить более чем 20 сообщений в сутки, пользователям которые не входят в список ваших друзей";
$lang['MessageBoxTitleSpamWarrning'] = "Внимание";

//Invite
$lang['Invite'] = "Пригласить друга";
$lang['Information'] = "Информация о Вашем друге";
$lang['Note'] = "Кого можно пригласить?";
$lang['NoteAnswer'] = "Приглашать можно только тех, с кем Вы знакомы. Спам категорически запрещен.";
$lang['Email'] = "E-mail:*";
$lang['FirstName'] = "Имя:";
$lang['LastName'] = "Фамилия:";
$lang['Send'] = "Отправить приглашение";

//Send Message
$lang['send_message'] = "Новое сообщение";
$lang['From'] = "От кого:";
$lang['To'] = "Кому:";
$lang['Subject'] = "Тема:";
$lang['Text'] = "Сообщение:";
$lang['Previous'] = "Предыдущие сообщение";

//MyMessages
$lang['MyMessages'] = "Мои сообщения";
$lang['MessagesFilter'] = "Фильтр сообщений";
$lang['MyMessagesCount'] = "У Вас {Number} сообщений";
$lang['Sender'] = "Отправитель";
$lang['Action'] = "Действия";
$lang['Answer'] = "Ответ";
$lang['Delete'] = "Удалить";
$lang['MessageSubject'] = "Тема";

//Get Message
$lang['GetMessage'] = "Мои сообщения";

?>