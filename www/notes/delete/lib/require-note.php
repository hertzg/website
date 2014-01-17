<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
include_once __DIR__.'/../../../classes/Notes.php';
list($id) = request_strings('id');
$id = abs((int)$id);
$note = Notes::get($idusers, $id);
if (!$note) {
    include_once __DIR__.'/../../../fns/redirect.php';
    redirect('..');
}
