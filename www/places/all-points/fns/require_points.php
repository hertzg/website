<?php

function require_points ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_place.php';
    $values = require_place($mysqli, $base);
    list($place, $id, $user) = $values;

    if ($place->num_points <= 1) {
        unset($_SESSION['places/view/messages']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base../view/?id=$id");
    }

    return $values;

}
