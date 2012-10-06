<tr id="message-<?php echo $message->id; ?>">
    <td><?php $message->getAuthor(); ?></td>
    <td><?php $message->getDatecreate(); ?></td>
    <td><?php $message->getText(); ?></td>
    <td><?php $message->getAnswer(); ?></td>
    <td>
        <?php if(Yii::app()->user->checkAccess('guestbook_admin_message')) { ?>
            <a href="<?php echo Yii::app()->createUrl('guestbook/index/editMessage', array('id'=>$message->id)); ?>">Изменить</a>
        <?php } ?>
    </td>
    <td>
        <?php if(Yii::app()->user->checkAccess('guestbook_admin_message_remove')) { ?>
            <a href="" onClick="removeMessage(<?php echo $message->id; ?>); return false;">Удалить</a>
        <?php } ?>
    </td>
</tr>