<?php
/**
 * Иерархия ролей.
 */
return array(
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
            'user',

            'access_cms'
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => array(
            'access_cms'
        ),
        'bizRule' => null,
        'data' => null,
    ),

    'access_cms' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Доступ к CMS',
        'children' => array(
        ),
        'bizRule' => null,
        'data' => null,
    ),
);