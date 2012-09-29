<?php
/**
 * Иерархия ролей.
 */
return array(
/**
 * Глобаьные роли.
 */
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администраторы',
        'children' => array(
            'user',

            'user_admin_profile_login',
            'user_admin_profile_group',
            'user_admin_profile_confirm',

            'anime_access_cms',
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Пользователи',
        'children' => array(
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'block' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'заблокированные',
        'children' => array(
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

/**
 * МОДУЛЬ "USER"
 */
    'user_access_cms' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Доступ к CMS',
        'children' => array(
            'access_cms',
        ),
        'bizRule' => null,
        'data' => null,
    ),

    'user_admin_profile' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Редактирование профиля',
        'children' => array(
            'user_access_cms',
        ),
        'bizRule' => null,
        'data' => null,
    ),
            'user_admin_profile_login' => array(
                'type' => CAuthItem::TYPE_OPERATION,
                'description' => 'Редактирование логина',
                'children' => array(
                    'user_admin_profile',
                ),
                'bizRule' => null,
                'data' => null,
            ),
            'user_admin_profile_group' => array(
                'type' => CAuthItem::TYPE_OPERATION,
                'description' => 'Редактирование группы',
                'children' => array(
                    'user_admin_profile',
                ),
                'bizRule' => null,
                'data' => null,
            ),
            'user_admin_profile_confirm' => array(
                'type' => CAuthItem::TYPE_OPERATION,
                'description' => 'Редактирование активации',
                'children' => array(
                    'user_admin_profile',
                ),
                'bizRule' => null,
                'data' => null,
            ),

/**
 * МОДУЛЬ "ANIME"
 */
    'anime_access_cms' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Доступ к CMS',
        'children' => array(
            'access_cms',
        ),
        'bizRule' => null,
        'data' => null,
    ),
);