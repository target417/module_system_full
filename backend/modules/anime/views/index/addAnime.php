<h1>Новое аниме</h1>

<?php $form = $this->beginWidget('ActiveForm', array(
    'enableClientValidation' => true,
    'focus' => array($anime, 'headline'),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); ?>

    <div class="row long">
        <?php echo $form->label($anime, 'headline'); ?>
        <?php echo $form->textField($anime, 'headline'); ?>
        <?php echo $form->note($anime, 'headline'); ?>
        <?php echo $form->error($anime, 'headline'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'section'); ?>
        <?php echo $form->dropDownList($anime, 'section', MAnimeSection::model()->getListForDdl()); ?>
        <?php echo $form->note($anime, 'section'); ?>
        <?php echo $form->error($anime, 'section'); ?>
    </div>

    <div class="row long">
        <?php echo $form->label($anime, 'full_name'); ?>
        <?php echo $form->textarea($anime, 'full_name', array(
            'rows' => 7,
        )); ?>
        <?php echo $form->note($anime, 'full_name'); ?>
        <?php echo $form->error($anime, 'full_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($anime, 'cover'); ?>
        <?php echo $form->fileField($anime, 'cover'); ?>
        <?php echo $form->note($anime, 'cover'); ?>
        <?php echo $form->error($anime, 'cover'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($anime, 'screen'); ?>
        <?php echo $form->fileField($anime, 'screen_1'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_1'); ?>
    </div>

    <div class="row">
        <span class="label"></span>
        <?php echo $form->fileField($anime, 'screen_2'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_2'); ?>
    </div>

    <div class="row">
        <span class="label"></span>
        <?php echo $form->fileField($anime, 'screen_3'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_3'); ?>
    </div>

    <div class="row">
        <span class="label"></span>
        <?php echo $form->fileField($anime, 'screen_4'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_4'); ?>
    </div>

    <div class="row">
        <span class="label"></span>
        <?php echo $form->fileField($anime, 'screen_5'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_5'); ?>
    </div>

    <div class="row">
        <span class="label"></span>
        <?php echo $form->fileField($anime, 'screen_6'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_6'); ?>
    </div>

    <div class="row">
        <span class="label"></span>
        <?php echo $form->fileField($anime, 'screen_7'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_7'); ?>
    </div>

    <div class="row">
        <span class="label"></span>
        <?php echo $form->fileField($anime, 'screen_8'); ?>
        <?php echo $form->note($anime, 'screen'); ?>
        <?php echo $form->error($anime, 'screen_8'); ?>
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
        <?php echo $form->label($anime, 'edition_begin'); ?>
        <?php echo $form->textField($anime, 'edition_begin'); ?>
        <?php echo $form->note($anime, 'edition_begin'); ?>
        <?php echo $form->error($anime, 'edition_begin'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'edition_end'); ?>
        <?php echo $form->textField($anime, 'edition_end'); ?>
        <?php echo $form->note($anime, 'edition_end'); ?>
        <?php echo $form->error($anime, 'edition_end'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'edition_details'); ?>
        <?php echo $form->textField($anime, 'edition_details'); ?>
        <?php echo $form->note($anime, 'edition_details'); ?>
        <?php echo $form->error($anime, 'edition_details'); ?>
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

    <div class="row">
        <?php echo $form->label($anime, 'subs_lang'); ?>
        <?php echo $form->dropDownList($anime, 'subs_lang', MAnime::getSubsLangsListForDdl()); ?>
        <?php echo $form->note($anime, 'subs_lang'); ?>
        <?php echo $form->error($anime, 'subs_lang'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($anime, 'subs_author'); ?>
        <?php echo $form->textField($anime, 'subs_author'); ?>
        <?php echo $form->note($anime, 'subs_author'); ?>
        <?php echo $form->error($anime, 'subs_author'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton($anime->isNewRecord ? 'Добавить аниме' : 'Сохранить изменения'); ?>
    </div>

<?php $this->endWidget(); ?>