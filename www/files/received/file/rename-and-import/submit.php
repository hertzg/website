<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_received_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli, '../');

include_once "$fnsDir/Files/request.php";
$name = Files\request();

$id_folders = 0;
$errors = [];

if ($name === '') $errors[] = 'Enter file name.';
else {

    include_once "$fnsDir/Files/getByName.php";
    $existingFile = Files\getByName($mysqli,
        $user->id_users, $id_folders, $name);

    if ($existingFile) $errors[] = 'A file with this name already exists.';

}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['files/received/file/rename-and-import/errors'] = $errors;
    $_SESSION['files/received/file/rename-and-import/values'] = [
        'name' => $name,
    ];
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset(
    $_SESSION['files/received/file/rename-and-import/errors'],
    $_SESSION['files/received/file/rename-and-import/values']
);

$receivedFile->name = $name;

include_once "$fnsDir/Users/Files/Received/import.php";
Users\Files\Received\import($mysqli, $receivedFile, $id_folders);

$messages = ['File has been imported.'];

if ($user->num_received_files == 1 && !$user->num_received_folders) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../../..');
}

unset($_SESSION['files/received/errors']);
$_SESSION['files/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../../'));
