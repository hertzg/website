<?php

function create_content ($mysqli, $folder, $user, $files, $items, $infoText) {

    $fnsDir = __DIR__.'/../../fns';
    $id = $folder ? $folder->id_folders : 0;

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/create_location_bar.php';
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    $content =
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../home/#files',
                ],
            ],
            'Files',
            Page\sessionErrors('files/errors')
            .Page\sessionMessages('files/messages')
            .create_location_bar($mysqli, $folder)
            .join('<div class="hr"></div>', $items)
            .$infoText
        )
        .create_options_panel($user, $id, $files);

    if ($id) {
        include_once __DIR__.'/create_folder_options_panel.php';
        $content .= create_folder_options_panel($id);
    }

    return $content;

}
