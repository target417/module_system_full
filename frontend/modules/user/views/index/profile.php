<h1>Профиль пользователя</h1>
<p><b>Логин</b>: <?php $user->getLogin(false); ?></p>
<p><b>Пол</b>: <?php $user->getSex(); ?></p>
<p><b>День рождения</b>: <?php $user->getBirthday(); ?></p>
<p><b>Дата регистрации</b>: <?php $user->getDateReg(); ?></p>
<p><b>Имя</b>: <?php $user->getName(); ?></p>
<p><b>Последнее посещение</b>: <?php $user->getLastOnline(); ?></p>