<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

include_once '../../fns/Files/request.php';
$name = Files\request();

$errors = [];

if ($name === '') $errors[] = 'Enter file name.';
else {

    include_once '../../fns/Files/getByName.php';
    include_once '../../lib/mysqli.php';
    $existingFile = Files\getByName($mysqli,
        $user->id_users, $file->id_folders, $name, $id);

    if ($existingFile) $errors[] = 'A file with this name already exists.';

}

$values = ['name' => $name];
$_SESSION['files/rename-file/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-file/errors'] = $errors;
    redirect("./?id=$id");
}

unset($_SESSION['files/rename-file/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton) {
    unset(
        $_SESSION['files/rename-file/send/errors'],
        $_SESSION['files/rename-file/send/messages'],
        $_SESSION['files/rename-file/send/values']
    );
    $_SESSION['files/rename-file/send/file'] = $values;
    redirect("send/?id=$id");
}

unset($_SESSION['files/rename-file/values']);

include_once '../../fns/Files/rename.php';
Files\rename($mysqli, $id, $name, null);

$_SESSION['files/view-file/messages'] = ['File has been renamed.'];
unset($_SESSION['files/view-file/errors']);

redirect("../view-file/?id=$id");
