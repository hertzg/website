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
include_once "$fnsDir/Page/imageArrowLink.php";

foreach ($receivedFolders as $receivedFolder) {
    $title = htmlspecialchars($receivedFolder->name);
    $href = "folder/?id=$receivedFolder->id";
    $html = Page\imageArrowLink($title, $href, 'folder');
    $items[$receivedFolder->insert_time] = $html;
}

foreach ($receivedFiles as $receivedFile) {
    $title = htmlspecialchars($receivedFile->name);
    $href = "file/?id=$receivedFile->id";
    $html = Page\imageArrowLink($title, $href, 'file');
    $items[$receivedFile->insert_time] = $html;
}

ksort($items);
$items = array_reverse($items);
$items = array_values($items);

if (!$all) {
    if ($user->num_archived_received_folders ||
        $user->num_archived_received_files) {

        include_once "$fnsDir/Form/button.php";
        $items[] =
            '<form action="./">'
                .Form\button('Show Archived Files')
                .'<input type="hidden" name="all" value="1" />'
            .'</form>';

    }
}

$title = 'Delete All Files';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Files',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('files/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Received Files', $content, '../../');
