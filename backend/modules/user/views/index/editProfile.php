<h1>Редактирование профиля пользователя</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
)); ?>

    <div class="row">
        <?php echo $form->label($user, 'login'); ?>
        <?php if(Yii::app()->user->checkAccess('user_admin_profile_login'))
            echo $form->textField($user, 'login');
        else
            echo $form->textField($user, 'login', array(
                'disabled' => 'disabled',
            )); ?>
        <?php echo $form->note($user,'login'); ?>
        <?php echo $form->error($user,'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($user, 'group'); ?>
        <?php if(Yii::app()->user->checkAccess('user_admin_profile_group'))
            echo $form->dropDownList($user, 'group', MUserGroup::getListForDdl());
        else
            echo $form->dropDownList($user, 'group', MUserGroup::getListForDdl(), array(
                'disabled' => 'disabled',
            )); ?>
        <?php echo $form->note($user,'group'); ?>
        <?php echo $form->error($user,'group'); ?>
    </div>

    <div class="row">
        <p>
            <span class="label"></span>
            <?php if(Yii::app()->user->checkAccess('user_admin_profile_confirm'))
                echo $form->checkBox($user, 'is_confirm');
            else
                echo $form->checkBox($user, 'is_confirm', array(
                    'disabled' => 'disabled',
                )); ?>
            Пользователь активирован
        </p>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Сохранить изменения'); ?>
    </div>

<?php $this->endWidget(); ?>