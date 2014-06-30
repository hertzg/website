<?php

function create_location_bar ($mysqli, $file) {

    $fnsDir = __DIR__.'/../../../../../../fns';
    $id_users = $file->id_users;

    include_once "$fnsDir/ReceivedFolderSubfolders/getOnUser.php";
    $parentFolder = \ReceivedFolderSubfolders\getOnUser(
        $mysqli, $id_users, $file->parent_id);

    $rootHref = "../../?id=$parentFolder->id_received_folders";
    $html =
        '<div class="page-tags tagFilterBar">'
            .'<span class="label">Location:</span>'
            ."<a class=\"tag\" href=\"$rootHref\">root</a>";

    $parentFolders = [$parentFolder];
    while ($parentFolder->parent_id) {
        $parentFolder = \ReceivedFolderSubfolders\getOnUser(
            $mysqli, $id_users, $parentFolder->parent_id);
        $parentFolders[] = $parentFolder;
    }
    $parentFolders = array_reverse($parentFolders);

    foreach ($parentFolders as $parentFolder) {
        $html .=
            "<a class=\"tag\" href=\"../?id=$parentFolder->id\">"
                .htmlspecialchars($parentFolder->name)
            .'</a>';
    }

    $html .= '</div>';

    return $html;

}
