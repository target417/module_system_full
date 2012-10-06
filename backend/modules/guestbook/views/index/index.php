<h1>Управление гостевой книгой</h1>

<!-- Список сообщений -->
<?php $this->renderPartial('index_messagesList', array(
    'messagesList' => $messagesList,
)); ?>