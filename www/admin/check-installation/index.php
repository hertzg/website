<?php

function assert_readable_file ($file) {
    $file = resolve_path($file);
    return
        visual_assert(is_file($file), "File \"$file\" exists")
        .visual_assert(is_readable($file), "File \"$file\" readable");
}

function assert_writable_file ($file) {
    $file = realpath($file);
    return
        visual_assert(is_file($file), "File \"$file\" exists")
        .visual_assert(is_readable($file), "File \"$file\" readable")
        .visual_assert(is_writable($file), "File \"$file\" writable");
}

function assert_writable_dir ($dir) {
    $dir = resolve_path($dir);
    return
        visual_assert(is_dir($dir), "Directory \"$dir\" exists")
        .visual_assert(is_writable($dir), "Directory \"$dir\" writable");
}

function resolve_path ($path) {
    $regex = '#/[^/.]+?/\.\.#';
    while (preg_match($regex, $path)) $path = preg_replace($regex, '', $path);
    return $path;
}

function visual_assert ($ok, $text) {
    if ($ok) $class = 'ok';
    else $class = 'not_ok';
    return
        "<li class=\"status $class\">"
            ."<span class=\"bullet $class\">&bull;</span> "
            .$text
        ."</li>";
}

include_once '../fns/require_admin.php';
require_admin();

$content = '<ul style="font-family: monospace; white-space: pre-wrap">';

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$content .= visual_assert($ok, 'Apache mod_rewrite enabled');

$ok = in_array('mod_headers', $apacheModules);
$content .= visual_assert($ok, 'Apache mod_headers enabled');

$ok = date_default_timezone_get() === 'UTC';
$content .= visual_assert($ok, 'PHP default timezone set to UTC');

$ok = function_exists('curl_init');
$content .= visual_assert($ok, 'PHP Client URL Library installed');

$ok = function_exists('imagecreatefromstring');
$content .= visual_assert($ok, 'PHP image processing and GD installed');

$ok = function_exists('mysqli_connect');
$content .= visual_assert($ok, 'PHP MySQL improved extension installed');

$content .= assert_writable_file('../fns/get_admin.php');
$content .= assert_writable_file('../../fns/get_mysqli_config.php');

include_once '../../fns/Users/Directory/dir.php';
assert_writable_dir(Users\Directory\dir());

include_once '../../lib/mysqli.php';
include_once '../../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');
if ($users) {
    include_once '../../fns/Files/File/dir.php';
    include_once '../../fns/ReceivedFiles/File/dir.php';
    include_once '../../fns/ReceivedFolderFiles/File/dir.php';
    foreach ($users as $user) {
        $id_users = $user->id_users;
        $content .=
            assert_writable_dir(Files\File\dir($id_users))
            .assert_writable_dir(ReceivedFiles\File\dir($id_users))
            .assert_writable_dir(ReceivedFolderFiles\File\dir($id_users));
    }
}

$files = mysqli_query_object($mysqli, 'select * from files');
if ($files) {
    include_once '../../fns/Files/File/path.php';
    foreach ($files as $file) {
        $path = Files\File\path($file->id_users, $file->id_files);
        $content .= assert_readable_file($path);
    }
}

$receivedFiles = mysqli_query_object($mysqli, 'select * from received_files');
if ($receivedFiles) {
    include_once '../../fns/ReceivedFiles/File/path.php';
    foreach ($receivedFiles as $receivedFile) {
        $receiver_id_users = $receivedFile->receiver_id_users;
        $path = ReceivedFiles\File\path($receiver_id_users, $receivedFile->id);
        $content .= assert_readable_file($path);
    }
}

$sql = 'select * from received_folder_files';
$receivedFolderFiles = mysqli_query_object($mysqli, $sql);
if ($receivedFolderFiles) {
    include_once '../../fns/ReceivedFolderFiles/File/path.php';
    foreach ($receivedFolderFiles as $receivedFolderFile) {
        $id_users = $receivedFolderFile->id_users;
        $id = $receivedFolderFile->id;
        $path = ReceivedFolderFiles\File\path($id_users, $id);
        $content .= assert_readable_file($path);
    }
}

$content .= '</ul>';

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../',
        ],
    ],
    'Check Installation',
    Page\text($content)
);

include_once '../../fns/echo_guest_page.php';
echo_guest_page('Check Installation', $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css" />',
]);
