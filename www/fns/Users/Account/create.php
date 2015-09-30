<?php

namespace Users\Account;

function create ($mysqli, $username, $password, $email, $insertApiKey = null) {

    include_once __DIR__.'/../add.php';
    $id = \Users\add($mysqli, $username, $password, $email, $insertApiKey);

    include_once __DIR__.'/../Directory/mkdirs.php';
    \Users\Directory\mkdirs($id);

    return $id;

}
