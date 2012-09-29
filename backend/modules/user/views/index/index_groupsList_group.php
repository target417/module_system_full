<tr>
    <td>
        <a href="<?php echo Yii::app()->createUrl('user/index/index', array('group'=>$group['id'])); ?>">
            <?php echo $group['group']; ?>
        </a>
    </td>
    <td>
        <?php echo $group['countUsers']; ?>
    </td>

</tr>