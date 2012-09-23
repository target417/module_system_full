<h1>Регистрация</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
    'focus' => array($user, 'login'),
)); ?>
<?php echo CHtml::errorSummary(array($user, $userFull)); ?>
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
        <?php echo $form->label($user, 'password2'); ?>
        <?php echo $form->passwordField($user, 'password2'); ?>
        <?php echo $form->error($user, 'password2'); ?>
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