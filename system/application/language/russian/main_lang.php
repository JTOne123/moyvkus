<?php
$lang['title'] = "��� ����";
$lang['description'] = "";
$lang['keywords'] = "";

//����� �����������
$lang['sign_up_message'] = "����������� ������ ������������";
$lang['sign_up_slogan_message'] = "��� ������ � ��� �� ����� 1 ������"; 
$lang['first_name'] = "���:";
$lang['last_name'] = "�������:";
$lang['password'] = "������:";
$lang['email'] = "email:";
$lang['sign_up'] = "�����������";
$lang['captcha'] = "��� �� ��������";

//����� �����������
$lang['log_in'] = "�����";
$lang['forgot_password'] = "������ ������?";
$lang['checkbox_remember'] = "��������� ����";



//��������� �� �����������
$lang['Error_email'] = "��������� email �� ����������";
$lang['Error_firstname'] = "����� ����� ������ ���� �� ����� 4 ��������";
$lang['Error_lastname'] = "����� ������� ������ ���� �� ����� 4 ��������";
$lang['Error_password'] = "������ ������ ���� �� ����� 6 ��������";
$lang['Error_captcha'] = "��� � �������� ������ ��������� 4 �������";
$lang['captcha_check'] = "<div class = \"Registraion_validator\" style=\"display:block;\">��� � �������� ������ �� �����! ���������� ��� ���</div>";
$lang['email_check'] = "<div class = \"Registraion_validator\" style=\"display:block;\">������������ � ����� email ��� ���������������!</div>";
 //����� �����������
$lang['check_user_mail_exist'] = "<div class = \"Registraion_validator MessageWide\" style=\"display:block;\">������������ � ����� email �� ����������!</div>";
$lang['check_password'] = "<div class = \"Registraion_validator\" style=\"display:block;\">������ �������� ����� ��� ������.</div>";


//Notification
$lang['AfterRegistraionEmailFrom'] = "support@moyvkus.ru";
$lang['AfterRegistraionEmailFromName'] = "��� ���� - ���������";
$lang['AfterRegistraionEmailSubject'] = "����������� �������";
$lang['AfterRegistraionEmailMessage'] = "<html>
										<body>
										<p>���������(��) {first_name} {last_name}</p>
										<p>���� ������� ������ ������������</p>
										<p>��� ������: {password}</p>
										<p>� ���������, ������������� moyvkus.ru</p>
										</body>
										</html>";
										
//Profile
$lang['Prifile'] = "�������";
$lang['Edit'] = "�������������";
$lang['Avatar'] = "������";
$lang['MyFriendsHeader'] = "��� ������";
$lang['MyData'] = "������ ����������";
$lang['FirstNameText'] = "���:";
$lang['LastNameText'] = "�������:";
$lang['SexText'] = "���:";
$lang['BirthdayText'] = "���� ��������:";
$lang['LoctionText'] = "��������������:";
$lang['WebSiteText'] = "���-����:";
$lang['InstantMessagerText'] = "�������:";
$lang['ActivitiesText'] = "������������:";
$lang['InterestsText'] = "��������:";
$lang['AboutText'] = "� ����:";
$lang['MyRatingText'] = "��� �������:";
$lang['MyRatingLevelText'] = "�������:";
$lang['MyBestRecipesText'] = "������ ������:";
$lang['MyRecipes'] = "��� �������";
$lang['MyInfo'] = "� ����";
$lang['Contacts'] = "���������� ����������";
$lang['MyRatingTextHeader'] = "��������";
$lang['Man'] = "�������";
$lang['Woman'] = "�������";

//Edit profile
$lang['EditPrifile'] = "�������������� ��������";
$lang['LoginInformation'] = "��������������� ����������";
$lang['NewEmailText'] = "E-mail:";
$lang['OldPasswordText'] = "������ ������:";
$lang['NewPassword'] = "����� ������:";
$lang['ReNewPassword'] = "������ ������ ������:";
$lang['SaveAllChanges'] = "��������� ��� ���������?";
$lang['Save'] = "���������";
$lang['Upload'] = "���������";
$lang['Day'] = "����";
$lang['Month'] = "�����";
$lang['Year'] = "���";
$lang['Country'] = "������";
$lang['City'] = "�����";
$lang['MySettings'] = "��� ���������";
$lang['Cancel'] = "������";
$lang['Region'] = "������";
$lang['txtNewPassword'] = "������ ������ ���� �� ����� 6 ��������";

//My friends
$lang['MyFriends'] = "��� ������";
$lang['FriendsFilter'] = "������ ������";
$lang['Search'] = "�����";
$lang['MyFriendsCount'] = "� ��� {Number} ������";
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
$lang['SendMessage'] = "��������� ���������";
$lang['FriendFriends'] = "���(��) ������";
$lang['DeleteFriend'] = "������ �� ������";


?>