<h1>Новое сообщение</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
    'focus' => array($message, 'text'),
)); ?>

    <div class="row long">
        <?php echo $form->label($message, 'text'); ?>
        <?php echo $form->textArea($message, 'text', array(
            'rows' => 7,
        )); ?>
        <?php echo $form->note($message,'text'); ?>
        <?php echo $form->error($message,'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($message, 'author'); ?>
        <?php echo $form->textField($message, 'author'); ?>
        <?php echo $form->note($message, 'author'); ?>
        <?php echo $form->error($message, 'author'); ?>
    </div>

     <div class="row">
        <?php echo $form->label($message, 'verifyCode'); ?>
        <?php echo $form->textField($message, 'verifyCode'); ?>
        <?php echo $form->note($message, 'verifyCode'); ?>
        <p>
            <span class="label"></span>
            <? $this->widget('Captcha'); ?>
        </p>
        <?php echo $form->error($message, 'verifyCode'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Добавить сообщение'); ?>
    </div>

<?php $this->endWidget(); ?>