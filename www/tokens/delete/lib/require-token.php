<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
include_once __DIR__.'/../../../classes/Tokens.php';
list($id) = request_strings('id');
$id = abs((int)$id);
$token = Tokens::getOnUser($idusers, $id);
if (!$token) {
    include_once __DIR__.'/../../../fns/redirect.php';
    redirect('..');
}

