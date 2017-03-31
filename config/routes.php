<?php

/*
 * MVC routes
 * Example:
 * '' => 'site/index' use actionIndex in SiteController
 *
 * */

return array(

    'admin/add' => 'admin/add',
    'admin' => 'admin/index',

    'user/([0-9]+)' => 'user/profile/$1',
    'user/addToFriend' => 'user/addToFriend',
    'user/confirmFriend' => 'user/confirmFriend',
    'user/deletePublication' => 'user/deletePublication',
    'user/searchUser' => 'user/searchUser',
    'login' => 'user/login',
    'logout' => 'user/logout',
    'register' => 'user/register',

    'site/createComment' => 'site/createComment',
    '' => 'site/index',
);