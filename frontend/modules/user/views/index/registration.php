<h1>Регистрация</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
    'focus' => array($user, 'login'),
)); ?>

    <div class="row">
        <?php echo $form->label($user, 'login'); ?>
        <?php echo $form->textField($user, 'login'); ?>
        <?php echo $form->note($user, 'login'); ?>
        <?php echo $form->error($user, 'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($user, 'password'); ?>
        <?php echo $form->passwordField($user, 'password'); ?>
        <?php echo $form->note($user, 'password'); ?>
        <?php echo $form->error($user, 'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($user, 'email'); ?>
        <?php echo $form->textField($user, 'email'); ?>
        <?php echo $form->note($user, 'email'); ?>
        <?php echo $form->error($user, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($user, 'verifyCode'); ?>
        <?php echo $form->textField($user, 'verifyCode'); ?>
        <?php echo $form->note($user, 'verifyCode'); ?>
        <p>
            <span class="label"></span>
            <? $this->widget('Captcha'); ?>
        </p>
        <?php echo $form->error($user, 'verifyCode'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Зарегистрироваться'); ?>
    </div>

<?php $this->endWidget(); ?>