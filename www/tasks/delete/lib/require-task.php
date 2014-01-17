<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
include_once __DIR__.'/../../../classes/Tasks.php';
list($id) = request_strings('id');
$id = abs((int)$id);
$task = Tasks::get($idusers, $id);
if (!$task) {
    include_once __DIR__.'/../../../fns/redirect.php';
    redirect('..');
}
