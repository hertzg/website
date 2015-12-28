<?php

function create_content ($mysqli, $folder, $parentFolder, $items) {

    $fnsDir = __DIR__.'/../../../fns';
    $id_folders = $folder->id_folders;

    include_once __DIR__.'/../../fns/create_move_location_bar.php';
    include_once "$fnsDir/create_folder_link.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/text.php";
    return Page\create(
        [
            'title' => 'Files',
            'href' => create_folder_link($id_folders, '../').'#move',
        ],
        "Move Folder #$id_folders",
        Page\sessionErrors('files/move-folder/errors')
        .Page\text(
            'Moving the folder "<b>'.htmlspecialchars($folder->name).'</b>".'
            .'<br />Select a folder to move the folder into:'
        )
        .create_move_location_bar($mysqli, $id_folders,
            $parentFolder, 'id_folders', 'parent_id')
        .join('<div class="hr"></div>', $items)
    );

}
