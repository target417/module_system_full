<h1>Управление пользователями</h1>

<!-- Спиоск групп -->
<?php $this->renderPartial('index_groupsList', array(
    'groupsList' => $groupsList,
)); ?>

<!-- Форма поиска пользователя -->
<?php echo CHtml::beginForm('', 'GET'); ?>
    <div class="row">
        <?php echo CHtml::label('Поиск в группе', 'searchString'); ?>
        <?php echo CHtml::textField('searchString'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton('Найти пользователя'); ?>
    </div>
<?php echo CHtml::endForm(); ?>

<!-- Список пользователей -->
<?php $this->renderPartial('index_usersList', array(
    'usersList' => $usersList,
)); ?>
