<h1>Удаление пользователя</h1>

<?php echo CHtml::beginForm(); ?>

    <div class="row">
        <p>Вы уверенны, что хотите удалить пользователя <b><?php $user->getLogin(); ?></b>?</p>
    </div>

    <div class="row submit">
        <a href="<?php echo Yii::app()->createUrl('user/index/index'); ?>">Отмена</a> <?php echo CHtml::submitButton('Удалить пользователя'); ?>
    </div>

<?php echo CHtml::endForm(); ?>