<h1>Вход на сайт</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
    'focus' => array($user, 'login'),
)); ?>

    <div class="row">
        <?php echo $form->label($user, 'login'); ?>
        <?php echo $form->textField($user, 'login'); ?>
        <?php echo $form->note($user,'login'); ?>
        <?php echo $form->error($user,'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($user, 'password'); ?>
        <?php echo $form->passwordField($user, 'password'); ?>
        <?php echo $form->note($user, 'password'); ?>
        <?php echo $form->error($user, 'password'); ?>
    </div>

    <div class="row">
        <p>
            <span class="label"></span>
            <?php echo $form->checkBox($user, 'saveMe', array(
                'checked' => 'checked',
            )); ?>
            Запомнить меня
        </p>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Войти'); ?>
    </div>

<?php $this->endWidget(); ?>