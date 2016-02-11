<?php

function require_folder_params ($mysqli,
    $id_users, $id_folders, &$name, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Folders/request.php";
    $name = Folders\request();

    if ($name === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_NAME"');
    }

    include_once "$fnsDir/request_strings.php";
    list($auto_rename) = request_strings('auto_rename');

    if ($auto_rename) {
        include_once "$fnsDir/Folders/getUniqueName.php";
        $name = Folders\getUniqueName($mysqli, $id_users, $id_folders, $name);
    }

    include_once "$fnsDir/Folders/getByName.php";
    $existingFolder = Folders\getByName($mysqli,
        $id_users, $id_folders, $name, $exclude_id);

    if ($existingFolder) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"FOLDER_ALREADY_EXISTS"');
    }

}
