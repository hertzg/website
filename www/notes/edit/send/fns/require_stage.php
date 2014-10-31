<?php

function require_stage ($mysqli, $base = '') {

    include_once __DIR__.'/../../../fns/require_note.php';
    list($note, $id, $user) = require_note($mysqli, "$base../");

    $key = 'notes/edit/send/note';
    if (!array_key_exists($key, $_SESSION)) {
        $fnsDir = __DIR__.'/../../../../fns';
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect("$base../".ItemList\itemQuery($id));
    }

    return [$user, $_SESSION[$key], $id];

}
