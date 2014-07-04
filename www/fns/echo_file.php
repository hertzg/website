<?php

function echo_file ($file, $path) {

    session_commit();

    include_once __DIR__.'/request_strings.php';
    list($contentType) = request_strings('contentType');

    include_once __DIR__.'/str_collapse_spaces.php';
    $contentType = str_collapse_spaces($contentType);

    if ($contentType === '') $contentType = 'application/x-octet-stream';
    else {
        $filename = addslashes($file->name);
        header("Content-Disposition: attachment; filename=\"$filename\"");
    }

    header_remove('Expires');
    header_remove('Pragma');
    header_remove('X-Powered-By');
    header('Cache-Control: private, max-age='.(60 * 60 * 24 * 30 * 12));
    header("Content-Type: $contentType");
    header("Content-Length: $file->size");

    readfile($path);

}
