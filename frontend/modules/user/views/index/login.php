<!--
    Форма входа пользователя в систему.

    $user - экземпляр MUser;
-->

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
    'focus' => array($user,'login'),
)); ?>
<?php echo $form->errorSummary($user); ?>
<?php echo $form->textField($user, 'login'); ?>
<?php echo $form->passwordField($user, 'password'); ?>
<?php echo $form->checkBox($user, 'saveMe', array(
    'checked' => 'checked',
)); ?>
<?php echo CHtml::submitButton('asd'); ?>
<?php $this->endWidget(); ?>