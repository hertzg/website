<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../../fns';

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

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        foreach ($receivedFolders as $receivedFolder) {
            $title = htmlspecialchars($receivedFolder->name);
            $description = create_sender_description($receivedFolder);
            $id = $receivedFolder->id;
            $html = Page\imageArrowLinkWithDescription($title, $description,
                "{$base}folder/?id=$id", 'folder', ['id' => "folder_$id"]);
            $items[$receivedFolder->insert_time] = $html;
        }

        foreach ($receivedFiles as $receivedFile) {
            $title = htmlspecialchars($receivedFile->name);
            $description = create_sender_description($receivedFile);
            $id = $receivedFile->id;
            $html = Page\imageArrowLinkWithDescription($title, $description,
                "{$base}file/?id=$id", "$receivedFile->media_type-file",
                ['id' => "file_$id"]);
            $items[$receivedFile->insert_time] = $html;
        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No received files');
    }

    ksort($items);
    $items = array_reverse($items);
    $items = array_values($items);

    if (!$all) {
        if ($user->num_archived_received_folders ||
            $user->num_archived_received_files) {

            include_once "$fnsDir/Page/buttonLink.php";
            $items[] = Page\buttonLink('Show Archived Files', '?all=1');

        }
    }

    include_once __DIR__.'/create_content.php';
    return create_content($user, $items, $base);

}
