<h1>Управление пользователями</h1>

<!-- Список пользователей -->
<?php $this->renderPartial('index_usersList', array(
    'usersList' => $usersList,
)); ?>
