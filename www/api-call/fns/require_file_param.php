<?php

function require_file_param () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_files.php";
    list($file) = request_files('file');

    $error = $file['error'];
    if ($error === UPLOAD_ERR_NO_FILE) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"SELECT_FILE"');
    } elseif ($error !== UPLOAD_ERR_OK) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"FILE_ERROR"');
    }

    return $file;

}
