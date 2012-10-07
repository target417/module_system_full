<h1>Гостевая книга</h1>

<?php if(!empty($messagesList)) {
    foreach($messagesList AS $message) {
        $this->renderPartial('index_message', array(
            'message' => $message,
        ));
    }

    $this->widget('LinkPager', array('pages'=>$pages));
} else { ?>
    <p>В гостевой книге нет ни одного сообщения</p>
<?php } ?>

<a href="<?php echo Yii::app()->createUrl('guestbook/index/addMessage'); ?>">Добавить сообщение</a>