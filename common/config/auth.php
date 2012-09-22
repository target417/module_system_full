<?php
/**
 * Иерархия ролей.
 */
return array(
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => array(
        ),
        'bizRule' => null,
        'data' => null,
    ),
);