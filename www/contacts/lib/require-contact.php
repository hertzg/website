<?php

include_once 'require-user.php';
include_once __DIR__.'/../../fns/request_strings.php';
include_once __DIR__.'/../../classes/Contacts.php';
list($id) = request_strings('id');
$id = abs((int)$id);
$contact = Contacts::get($idusers, $id);
if (!$contact) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
