<h1>Профиль пользователя</h1>
<p><b>Логин</b>: <?php echo $user->login; ?></p>
<p><b>Пол</b>: <?php $user->getSex(); ?></p>
<p><b>День рождения</b>: <?php $user->getBirthday(); ?></p>
<p><b>Дата регистрации</b>: <?php $user->getDateReg(); ?></p>
<p><b>Имя</b>: <?php $user->getName(); ?></p>
<p><b>Последнее посещение</b>: <?php $user->getLastOnline(); ?></p>
<p><b>Группа</b>: <?php echo $user->getGroup(); ?></p>
<?php $this->renderDynamic('dynamicUserMenu', $user->id); ?>
<?php $user->getAvatar(); ?>