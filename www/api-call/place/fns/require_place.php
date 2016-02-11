<?php

function require_place ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Places/get.php";
    $place = Users\Places\get($mysqli, $user, $id);

    if (!$place) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"PLACE_NOT_FOUND"');
    }

    return $place;

}
