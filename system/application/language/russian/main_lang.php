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
										<p>С уважением, администрация moyvkus.ru</p>
										</body>
										</html>";
										
//Profile
$lang['Prifile'] = "Профайл";
$lang['Edit'] = "Редактировать";
$lang['Avatar'] = "Аватар";
$lang['MyFriendsHeader'] = "Мои друзья";
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

//Edit profile
$lang['EditPrifile'] = "Редактирование профайла";
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
$lang['FriendItem'] = "<div id=\"FriendsItem\" class=\"FriendsItem\">
						<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
							<tr>
								<td valign=\"top\">
									<a href=\"{FriendUrl}\">
										<img src=\"{FriendAvatarUrl}\" title=\"{FriendFullName}\" class=\"FriendAvatar\"/></a>
								</td>
								<td valign=\"top\">
									<table>
										<tr>
											<td class=\"LabelText\">
												{FullNameText}
											</td>
											<td class=\"LableValue\">
												<a href=\"{FriendUrl}\">{FriendFullName}</a>
											</td>
										</tr>
										<tr>
											<td class=\"LabelText\">
												{FriendRatingLevelText}
											</td>
											<td class=\"LableValue\">
												{FriendRatingLevel}
											</td>
										</tr>
										<tr>
											<td class=\"LabelText\">
												{FriendBestRecipeText}
											</td>
											<td class=\"LableValue\">
												<a href=\"{FriendBestRecipesUrl}\">{FriendBestRecipe}</a>
											</td>
										</tr>
									</table>
								</td>
								<td valign=\"top\">
									<table>
										<tr>
											<td>
												<a href=\"{SendMessageUrl}\" id=\"SendMessage\" name=\"SendMessage\">
													<div class=\"Login_submit\">
														{SendMessage}
													</div>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<a href=\"{FriendFriendsUrl}\" id=\"FriendFriends\" name=\"FriendFriends\">
													<div class=\"Login_submit\">
														{FriendFriends}
													</div>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<a href=\"{DeleteFriendUrl}\" id=\"DeleteFriend\" name=\"DeleteFriend\">
													<div class=\"Login_submit\">
														{DeleteFriend}
													</div>
												</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>";
$lang['SendMessage'] = "Отправить сообщение";
$lang['FriendFriends'] = "Его(ее) друзья";
$lang['DeleteFriend'] = "Убрать из друзей";


?>