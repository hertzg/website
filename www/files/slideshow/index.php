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
$name = $file->name;

$extension = pathinfo($name, PATHINFO_EXTENSION);
$extension = strtolower($extension);

include_once '../../fns/get_extension_content_type.php';
$contentType = get_extension_content_type($extension);

$contentType = rawurlencode($contentType);
$src = "../download-file/?id=$file->id_files&amp;contentType=$contentType";

if (preg_match('/^(flac|mp3|oga|wav)$/', $extension)) {
    $previewHtml = "<audio src=\"$src\" controls=\"controls\" />";;
} elseif (preg_match('/^(bmp|gif|jpe?g|png|svg)$/', $extension)) {
    $previewHtml = "<img src=\"$src\" />";;
} elseif (preg_match('/^(mp4|ogg|ogv)$/', $extension)) {
    $previewHtml = "<video src=\"$src\" controls=\"controls\" />";;
} else {
    $previewHtml = 'Preview not available';
}

$numFiles = count($files);
$prevHref = '?id='.$files[$index ? $index - 1 : $numFiles - 1]->id_files;
$nextHref = '?id='.$files[$index < $numFiles - 1 ? $index + 1 : 0]->id_files;
if ($parent_id_folders) {
    $param = "&amp;parent_id_folders=$parent_id_folders";
    $prevHref .= $param;
    $nextHref .= $param;
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
        ."<a class=\"clickable arrow left\" href=\"$prevHref\">"
            .'<span class="icon arrow-left"></span>'
        .'</a>'
        .'<div class="center">'
            .Page\buttonLink(htmlspecialchars($name), "../view-file/?id=$id")
        .'</div>'
        ."<a class=\"clickable arrow right\" href=\"$nextHref\">"
            .'<span class="icon arrow-right"></span>'
        .'</a>'
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
