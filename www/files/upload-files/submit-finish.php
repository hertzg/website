<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);

include_once "$fnsDir/request_strings.php";
list($num_uploaded, $num_failed) = request_strings(
    'num_uploaded', 'num_failed');

$num_uploaded = abs((int)$num_uploaded);
$num_failed = abs((int)$num_failed);

$errors = [];
if ($num_failed) {
    if ($num_failed == 1) $error = '1 file has failed to upload.';
    else $error = "$num_failed files have failed to upload.";
    $errors[] = $error;
}

include_once "$fnsDir/redirect.php";

if ($num_uploaded) {

    if ($num_uploaded == 1) $message = '1 file has been uploaded.';
    else $message = "$num_uploaded files have been uploaded.";

    if ($errors) $_SESSION['files/errors'] = $errors;
    else unset($_SESSION['files/errors']);

    $_SESSION['files/id_folders'] = $parent_id;
    $_SESSION['files/messages'] = [$message];

    include_once '../fns/create_parent_url.php';
    redirect(create_parent_url($parent_id, '../'));

}

if (!$num_failed) $errors[] = 'Select files to upload.';
$_SESSION['files/upload-files/errors'] = $errors;

$url = './';
if ($parent_id) $url .= "?parent_id=$parent_id";
redirect($url);
