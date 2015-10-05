<?php

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/view-file/errors'],
    $_SESSION['files/view-file/messages']
);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/Users/Files/indexPreviewableInFolder.php";
$files = Users\Files\indexPreviewableInFolder($mysqli, $user, $parent_id);

include_once "$fnsDir/request_strings.php";
list($id) = request_strings('id');

if (!$files) {
    include_once "$fnsDir/create_folder_link.php";
    include_once "$fnsDir/redirect.php";
    redirect('../'.create_folder_link($parent_id));
}

$index = 0;
foreach ($files as $i => $file) {
    if ($file->id_files == $id) {
        $index = $i;
        break;
    }
}

$file = $files[$index];
$id = $file->id_files;

$src = "../download-file/?id=$id&amp;contentType=$file->content_type"
    ."&amp;revision=$file->content_revision";

$media_type = $file->media_type;
if ($media_type == 'audio') {
    $previewHtml = "<audio src=\"$src\" controls=\"controls\" />";
} elseif ($media_type == 'image') {
    include_once "$fnsDir/compressed_js_script.php";
    $previewHtml =
        '<div class="imageProgress">'
            ."<img src=\"$src\" />"
        .'</div>'
        .compressed_js_script('imageProgress', $base);
} else {
    $previewHtml = "<video src=\"$src\" controls=\"controls\" />";
}

include_once 'fns/create_prev_link.php';
$prevLink = create_prev_link($files, $index, $parent_id);

include_once 'fns/create_next_link.php';
$nextLink = create_next_link($files, $index, $parent_id);

$title = htmlspecialchars($file->name);
include_once "$fnsDir/Page/buttonLink.php";
$fileLink = Page\buttonLink($title, "../view-file/?id=$id");

include_once "$fnsDir/create_folder_link.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Files',
            'href' => '../'.create_folder_link($parent_id).'#slideshow',
        ],
    ],
    'Slideshow',
    '<div class="navigation">'
        .$prevLink
        ."<div class=\"center\">$fileLink</div>"
        .$nextLink
    .'</div>'
    .'<div class="slideshow">'
        .'<span class="aligner"></span>'
        .$previewHtml
    .'</div>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Slideshow', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css?1" />',
]);
