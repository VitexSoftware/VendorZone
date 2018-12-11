<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once './vendor/autoload.php';

\Ease\Shared::instanced()->loadConfig('tests/vendorzone.json',true);

return array('environments' =>
    array(
        'default_database' => 'development',
        'development' => array(
            'name' => \Ease\Shared::db()->database,
            'connection' => \Ease\Shared::db()->sqlLink
        ),
        'default_database' => 'production',
        'production' => array(
            'name' => \Ease\Shared::db()->database,
            'connection' => \Ease\Shared::db()->sqlLink
        ),
    ),
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds'
    ]
);
