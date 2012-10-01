<h1>Новое аниме</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
    'focus' => array($anime, 'headline'),
)); ?>

    <div class="row long">
        <?php echo $form->label($anime, 'headline'); ?>
        <?php echo $form->textField($anime, 'headline'); ?>
        <?php echo $form->note($anime, 'headline'); ?>
        <?php echo $form->error($anime, 'headline'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'section'); ?>
        <?php echo $form->dropDownList($anime, 'headline', MAnimeSection::model()->getListForDdl()); ?>
        <?php echo $form->note($anime, 'section'); ?>
        <?php echo $form->error($anime, 'section'); ?>
    </div>

    <div class="row long">
        <?php echo $form->label($anime, 'description'); ?>
        <?php echo $form->textarea($anime, 'description', array(
            'rows' => 20,
        )); ?>
        <?php echo $form->note($anime, 'description'); ?>
        <?php echo $form->error($anime, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'type'); ?>
        <?php echo $form->textField($anime, 'type'); ?>
        <?php echo $form->note($anime, 'type'); ?>
        <?php echo $form->error($anime, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'dub_lang'); ?>
        <?php echo $form->dropDownList($anime, 'dub_lang', MAnime::getDubLangsListForDdl()); ?>
        <?php echo $form->note($anime, 'dub_lang'); ?>
        <?php echo $form->error($anime, 'dub_lang'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'dub_author'); ?>
        <?php echo $form->textField($anime, 'dub_author'); ?>
        <?php echo $form->note($anime, 'dub_author'); ?>
        <?php echo $form->error($anime, 'dub_author'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Добавить аниме'); ?>
    </div>

<?php $this->endWidget(); ?>