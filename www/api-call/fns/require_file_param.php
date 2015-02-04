<?php

function require_file_param () {

    include_once __DIR__.'/../../fns/request_files.php';
    list($file) = request_files('file');

    $error = $file['error'];
    if ($error === UPLOAD_ERR_NO_FILE) {
        include_once __DIR__.'/bad_request.php';
        bad_request('SELECT_FILE');
    } elseif ($error !== UPLOAD_ERR_OK) {
        include_once __DIR__.'/bad_request.php';
        bad_request('FILE_ERROR');
    }

    return $file;

}
