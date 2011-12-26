<?php
/**
 * File contain definitions of all roles
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 */

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => __('app','Guest'),
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => __('app','User'),
        'children' => array(
            'guest',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'moderator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => __('app','Moderator'),
        'children' => array(
            'user',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'administrator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => __('app','Administrator'),
        'children' => array(
            'moderator',
        ),
        'bizRule' => null,
        'data' => null
    ),
);