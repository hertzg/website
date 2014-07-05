<?php

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id_folders, $user) = require_parent_folder($mysqli);

include_once '../../fns/Files/indexInUserFolder.php';
$files = Files\indexInUserFolder($mysqli, $user->id_users, $parent_id_folders);

include_once '../../fns/request_strings.php';
list($id) = request_strings('id');

if (!$files) {
    include_once '../../create_folder_link.php';
    redirect(create_folder_link($parent_id_folders));
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

$src = "../download-file/?id=$id&amp;contentType=$file->content_type";

$media_type = $file->media_type;
if ($media_type == 'audio') {
    $previewHtml = "<audio src=\"$src\" controls=\"controls\" />";;
} elseif ($media_type == 'image') {
    $previewHtml = "<img src=\"$src\" />";;
} elseif ($media_type == 'video') {
    $previewHtml = "<video src=\"$src\" controls=\"controls\" />";;
} else {
    $previewHtml = 'Preview not available';
}

if ($index) {
    $href = '?id='.$files[$index - 1]->id_files;
    if ($parent_id_folders) {
        $href .= "&amp;parent_id_folders=$parent_id_folders";
    }
    $prevLink =
        "<a class=\"clickable arrow left\" href=\"$href\">"
            .'<span class="icon arrow-left"></span>'
        .'</a>';
} else {
    $prevLink = '';
}

if ($index < count($files) - 1) {
    $href = '?id='.$files[$index + 1]->id_files;
    if ($parent_id_folders) {
        $href .= "&amp;parent_id_folders=$parent_id_folders";
    }
    $nextLink =
        "<a class=\"clickable arrow right\" href=\"$href\">"
            .'<span class="icon arrow-right"></span>'
        .'</a>';
} else {
    $nextLink = '';
}

include_once '../../fns/create_folder_link.php';
include_once '../../fns/Page/buttonLink.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Files',
            'href' => '../'.create_folder_link($parent_id_folders),
        ],
    ],
    'Slideshow',
    '<div class="navigation">'
        .$prevLink
        .'<div class="center">'
            .Page\buttonLink(htmlspecialchars($file->name), "../view-file/?id=$id")
        .'</div>'
        .$nextLink
    .'</div>'
    .'<div class="slideshow">'
        .'<span class="aligner"></span>'
        .$previewHtml
    .'</div>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Slideshow', $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css" />',
]);
