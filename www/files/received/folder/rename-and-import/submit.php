<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

include_once "$fnsDir/Folders/request.php";
$name = Folders\request();

$errors = [];

$parent_id = 0;

if ($name === '') $errors[] = 'Enter folder name.';
else {
    include_once "$fnsDir/Folders/getByName.php";
    $existingFolder = Folders\getByName($mysqli,
        $user->id_users, $parent_id, $name);
    if ($existingFolder) $errors[] = 'A folder with this name already exists.';
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['files/received/folder/rename-and-import/errors'] = $errors;
    $_SESSION['files/received/folder/rename-and-import/values'] = [
        'name' => $name,
    ];
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset(
    $_SESSION['files/received/folder/rename-and-import/errors'],
    $_SESSION['files/received/folder/rename-and-import/values']
);

$messages = ['Folder has been imported.'];

$receivedFolder->name = $name;

include_once "$fnsDir/Users/Folders/Received/import.php";
Users\Folders\Received\import($mysqli, $receivedFolder, $parent_id);

if (!$user->num_received_files && $user->num_received_folders == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../../..');
}

unset($_SESSION['files/received/errors']);
$_SESSION['files/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../../'));
