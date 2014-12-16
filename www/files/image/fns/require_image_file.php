<?php

function require_image_file ($mysqli) {

    include_once __DIR__.'/../../fns/require_file.php';
    $values = require_file($mysqli);
    list($file, $id, $user) = $values;

    if ($file->media_type !== 'image') {
        unset(
            $_SESSION['files/view-file/errors'],
            $_SESSION['files/view-file/messages']
        );
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("../view-file/?id=$id");
    }

    return $values;

}
