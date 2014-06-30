<?php

function create_move_location_bar ($mysqli, $id, $folder, $item_id, $folder_id) {

    $html =
        '<div class="page-tags tagFilterBar">'
            .'<span class="label">Location:</span>';

    if ($folder) {

        $html .= "<a class=\"tag\" href=\"./?$item_id=$id\">root</a>";

        $parentFolders = [];
        $parent_id_folders = $folder->parent_id_folders;
        if ($parent_id_folders) {
            include_once __DIR__.'/../../fns/Folders/get.php';
            while ($parent_id_folders) {
                $parentFolder = \Folders\get($mysqli,
                    $folder->id_users, $parent_id_folders);
                $parent_id_folders = $parentFolder->parent_id_folders;
                $parentFolders[] = $parentFolder;
            }
        }
        $parentFolders = array_reverse($parentFolders);
        foreach ($parentFolders as $parentFolder) {
            $href = "./?$item_id=$id&amp;$folder_id=$parentFolder->id_folders";
            $html .=
                "<a class=\"tag\" href=\"$href\">"
                    .htmlspecialchars($parentFolder->name)
                .'</a>';
        }

        $html .=
            '<span class="tag active">'
                .htmlspecialchars($folder->name)
            .'</span>';

    } else {
        $html .= '<span class="tag active">root</span>';
    }

    $html .= '</div>';

    return $html;

}
