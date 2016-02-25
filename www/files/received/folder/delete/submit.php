<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

include_once "$fnsDir/Users/Folders/Received/delete.php";
Users\Folders\Received\delete($mysqli, $receivedFolder);

$messages = ["Received folder #$id has been deleted."];
include_once "$fnsDir/redirect.php";

if ($user->num_received_folders == 1 && !$user->num_received_files) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../../..');
}

unset($_SESSION['files/received/errors']);
$_SESSION['files/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../../'));
