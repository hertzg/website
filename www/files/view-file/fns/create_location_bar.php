<?php

function create_location_bar ($mysqli, $file) {

    $html =
        '<div class="page-tags tagFilterBar">'
            .'<span class="label">Location:</span>'
            .'<a class="tag" href="..">root</a>';

    $id_folders = $file->id_folders;
    if ($id_folders) {

        $id_users = $file->id_users;

        include_once __DIR__.'/../../../fns/Folders/get.php';
        $parentFolder = Folders\get($mysqli, $id_users, $id_folders);

        $parentFolders = [$parentFolder];
        $parent_id_folders = $parentFolder->parent_id_folders;
        while ($parent_id_folders) {
            $parentFolder = \Folders\get($mysqli,
                $id_users, $parent_id_folders);
            $parent_id_folders = $parentFolder->parent_id_folders;
            $parentFolders[] = $parentFolder;
        }
        $parentFolders = array_reverse($parentFolders);

        foreach ($parentFolders as $parentFolder) {
            $href = "../?id_folders=$parentFolder->id_folders";
            $html .=
                "<a class=\"tag\" href=\"$href\">"
                    .htmlspecialchars($parentFolder->name)
                .'</a>';
        }

    }

    $html .= '</div>';

    return $html;
    
}
