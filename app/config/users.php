<?php

/**
 * This file contains all users definitions and it roles as simple php array
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 */
return array(
    'admin' => array(
        'password' => md5('admin'.'F2vjNbk$I'),//please change it to result hash
        'salt' => 'F2vjNbk$I',
        'role' => 'administrator'
    ),
);