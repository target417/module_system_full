<h1>Редактирование сообщения</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
)); ?>

    <div class="row">
        <?php echo $form->label($message, 'author'); ?>
        <?php if(Yii::app()->user->checkAccess('guestbook_admin_message_author'))
            echo $form->textField($message, 'author');
        else
            echo $form->textField($message, 'author', array(
                'disabled' => 'disabled',
            )); ?>
        <?php echo $form->note($message,'author'); ?>
        <?php echo $form->error($message,'author'); ?>
    </div>

    <div class="row long">
        <?php echo $form->label($message, 'text'); ?>
        <?php if(Yii::app()->user->checkAccess('guestbook_admin_message_text'))
            echo $form->textArea($message, 'text', array(
                'rows' => 7,
            ));
        else
            echo $form->textArea($message, 'text', array(
                'rows' => 7,
                'disabled' => 'disabled',
            )); ?>
        <?php echo $form->note($message,'text'); ?>
        <?php echo $form->error($message,'text'); ?>
    </div>

    <div class="row long">
        <?php echo $form->label($message, 'answer'); ?>
        <?php if(Yii::app()->user->checkAccess('guestbook_admin_message_answer'))
            echo $form->textArea($message, 'answer', array(
                'rows' => 7,
            ));
        else
            echo $form->textArea($message, 'answer', array(
                'rows' => 7,
                'disabled' => 'disabled',
            )); ?>
        <?php echo $form->note($message,'answer'); ?>
        <?php echo $form->error($message,'answer'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Сохранить изменения'); ?>
    </div>

<?php $this->endWidget(); ?>