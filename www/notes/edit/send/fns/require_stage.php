<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_note.php';
    list($note, $id, $user) = require_note($mysqli, '../');

    $key = 'notes/edit/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect("../?id=$id");
    }

    return [$user, $_SESSION[$key], $id];

}
