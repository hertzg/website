<?php

function require_file_params ($mysqli,
    $id_users, $id_folders, &$name, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Files/request.php";
    $name = Files\request();

    if ($name === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_NAME"');
    }

    include_once "$fnsDir/request_strings.php";
    list($auto_rename) = request_strings('auto_rename');

    if ($auto_rename) {
        include_once "$fnsDir/Files/getUniqueName.php";
        $name = Files\getUniqueName($mysqli, $id_users, $id_folders, $name);
    }

    include_once "$fnsDir/Files/getByName.php";
    $existingFile = Files\getByName($mysqli,
        $id_users, $id_folders, $name, $exclude_id);

    if ($existingFile) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"FILE_ALREADY_EXISTS"');
    }

}
