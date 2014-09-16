<?php

include_once 'fns/require_received_files.php';
$user = require_received_files();
$id_users = $user->id_users;

include_once '../../fns/Users/Folders/Received/clearNumberNew.php';
include_once '../../lib/mysqli.php';
Users\Folders\Received\clearNumberNew($mysqli, $id_users);

include_once '../../fns/Users/Files/Received/clearNumberNew.php';
Users\Files\Received\clearNumberNew($mysqli, $id_users);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/received/file/messages'],
    $_SESSION['files/received/folder/messages']
);

$fnsDir = "../../fns";

include_once "$fnsDir/request_strings.php";
list($all) = request_strings('all');

$receivedFoldersDir = "$fnsDir/ReceivedFolders/Committed";
$receivedFilesDir = "$fnsDir/ReceivedFiles/Committed";

if ($all) {

    include_once "$receivedFoldersDir/indexOnReceiver.php";
    $receivedFolders = ReceivedFolders\Committed\indexOnReceiver(
        $mysqli, $id_users);

    include_once "$receivedFilesDir/indexOnReceiver.php";
    $receivedFiles = ReceivedFiles\Committed\indexOnReceiver(
        $mysqli, $id_users);

} else {

    include_once "$receivedFoldersDir/indexNotArchivedOnReceiver.php";
    $receivedFolders = ReceivedFolders\Committed\indexNotArchivedOnReceiver(
        $mysqli, $id_users);

    include_once "$receivedFilesDir/indexNotArchivedOnReceiver.php";
    $receivedFiles = ReceivedFiles\Committed\indexNotArchivedOnReceiver(
        $mysqli, $id_users);

}

$items = [];
include_once "$fnsDir/create_sender_description.php";
include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

if ($receivedFolders || $receivedFiles) {

    foreach ($receivedFolders as $receivedFolder) {
        $title = htmlspecialchars($receivedFolder->name);
        $description = create_sender_description($receivedFolder);
        $href = "folder/?id=$receivedFolder->id";
        $html = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'folder');
        $items[$receivedFolder->insert_time] = $html;
    }

    foreach ($receivedFiles as $receivedFile) {
        $title = htmlspecialchars($receivedFile->name);
        $description = create_sender_description($receivedFile);
        $href = "file/?id=$receivedFile->id";
        $icon = "$receivedFile->media_type-file";
        $html = Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon);
        $items[$receivedFile->insert_time] = $html;
    }

} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No received files');
}

ksort($items);
$items = array_reverse($items);
$items = array_values($items);

if (!$all) {
    if ($user->num_archived_received_folders ||
        $user->num_archived_received_files) {

        include_once '../../fns/Page/buttonLink.php';
        $items[] = Page\buttonLink('Show Archived Files', '?all=1');

    }
}

include_once 'fns/create_content.php';
$content = create_content($items);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Received Files', $content, '../../');
