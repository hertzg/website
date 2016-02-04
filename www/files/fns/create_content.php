<?php

function create_content ($mysqli, $folder,
    $user, $files, $items, $infoText, &$title, $base) {

    $fnsDir = __DIR__.'/../../fns';
    $id = $folder ? $folder->id_folders : 0;
    if ($folder) {
        $id = $folder->id_folders;
        $title = "Folder #$id";
    } else {
        $id = 0;
        $title = 'Files';
    }

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/create_tabs.php';
    include_once __DIR__.'/create_location_bar.php';
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    $content =
        Page\create(
            [
                'title' => 'Home',
                'href' => '../home/#files',
                'localNavigation' => true,
            ],
            $title,
            create_tabs($user)
            .Page\sessionErrors('files/errors')
            .Page\sessionMessages('files/messages')
            .create_location_bar($mysqli, $folder)
            .join('<div class="hr"></div>', $items)
            .$infoText
        )
        .create_options_panel($user, $id, $files, $base);

    if ($id) {
        include_once __DIR__.'/create_folder_options_panel.php';
        $content .= create_folder_options_panel($id, $base);
    }

    return $content;

}
