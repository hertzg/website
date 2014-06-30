<?php

function create_location_bar ($mysqli, $folder) {

    $rootHref = "../?id=$folder->id_received_folders";
    $html =
        '<div class="page-tags tagFilterBar">'
            .'<span class="label">Location:</span>'
            ."<a class=\"tag\" href=\"$rootHref\">root</a>";

    $parentFolders = [];
    $parent_id = $folder->parent_id;
    if ($parent_id) {
        $fnsDir = __DIR__.'/../../../../../fns';
        include_once "$fnsDir/ReceivedFolderSubfolders/getOnUser.php";
        while ($parent_id) {
            $parentFolder = \ReceivedFolderSubfolders\getOnUser($mysqli,
                $folder->id_users, $parent_id);
            $parent_id = $parentFolder->parent_id;
            $parentFolders[] = $parentFolder;
        }
    }
    $parentFolders = array_reverse($parentFolders);

    foreach ($parentFolders as $parentFolder) {
        $html .=
            "<a class=\"tag\" href=\"./?id=$parentFolder->id\">"
                .htmlspecialchars($parentFolder->name)
            .'</a>';
    }

    $html .=
            "<span class=\"tag active\">"
                .htmlspecialchars($folder->name)
            .'</span>'
        .'</div>';

    return $html;

}
