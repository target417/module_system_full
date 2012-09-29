<?php if(!empty($groupsList)) { ?>
    <table>
        <thead>
            <tr>
                <th>Группа</th>
                <th>Пользователей</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('user/index/index'); ?>">
                        Все группы
                    </a>
                </td>
            </tr>
            <?php while($group = each($groupsList)) {
                $this->renderPartial('index_groupsList_group', array(
                    'group' => $group[1],
                ));
            } ?>
        </tbody>
    </table>
<?php } ?>