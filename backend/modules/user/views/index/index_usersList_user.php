<tr>
    <td><?php $user->getLogin(); ?></td>

    <td><?php $user->getGroup(); ?></td>

    <td><?php $user->getDateReg(); ?></td>

    <td><?php $user->getLastOnline(); ?></td>

    <td><?php echo $user->getConfirm(); ?></td>

    <td>
        <?php if(Yii::app()->user->checkAccess('user_admin_profile')) { ?>
            <a href="<?php echo Yii::app()->createUrl('user/index/editProfile', array('id'=>$user->id)); ?>">
                Изменить
            </a>
        <? } ?>
    </td>

</tr>