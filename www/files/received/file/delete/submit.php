<?php

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli, '../');

include_once "$fnsDir/Users/Files/Received/delete.php";
Users\Files\Received\delete($mysqli, $receivedFile);

$messages = ["Received file #$id has been deleted."];
include_once "$fnsDir/redirect.php";

if (!$user->num_received_folders && $user->num_received_files == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../../..');
}

unset($_SESSION['files/received/errors']);
$_SESSION['files/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../../'));
