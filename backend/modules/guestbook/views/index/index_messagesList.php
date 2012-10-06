<?php if(!empty($messagesList)) { ?>
    <table>
        <thead>
            <tr>
                <th>Автор</th>
                <th>Дата</th>
                <th>Текст сообщения</th>
                <th>Ответ</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($messagesList AS $message) {
                $this->renderPartial('index_messagesList_message', array(
                    'message' => $message,
                ));
            } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>В гостевой книге нет ни одного сообщения</p>
<?php } ?>