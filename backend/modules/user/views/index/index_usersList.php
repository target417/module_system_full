<?php if(!empty($usersList)) { ?>
    <table>
        <thead>
            <tr>
                <th>Логин</th>
                <th>Группа</th>
                <th>Дата регистрации</th>
                <th>Последнее посещение</th>
                <th>Активация</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user = each($usersList)) {
                $this->renderPartial('index_usersList_user', array(
                    'user' => $user[1],
                ));
            } ?>
        </tbody>
    </table>

    <?php $this->widget('LinkPager', array('pages'=>$pages)) ?>
<?php } ?>