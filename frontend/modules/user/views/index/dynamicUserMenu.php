<ul>
    <?php if(!Yii::app()->user->isGuest) {
        if(Yii::app()->user->id == $id) {
            ?><li><a href="<?php echo Yii::app()->createUrl('user/index/editProfile'); ?>">Редактировать профиль</a></li><?php
        }
    } ?>
</ul>