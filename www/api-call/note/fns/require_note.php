<?php

function require_note ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Notes/get.php";
    $note = Users\Notes\get($mysqli, $user, $id);

    if (!$note) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"NOTE_NOT_FOUND"');
    }

    return $note;

}
