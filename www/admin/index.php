<?php

function assert_readable_file ($file) {
    $file = resolve_path($file);
    $ok = is_file($file);
    return visual_assert($ok, "File \"$file\" exists");
}

function assert_writable_dir ($dir) {

    $dir = resolve_path($dir);

    $ok = is_dir($dir);
    $html = visual_assert($ok, "Directory \"$dir\" exists");

    $file = "$dir/test";
    $ok = @file_put_contents($file, 'test');
    if ($ok) unlink($file);
    $html .= visual_assert($ok, "Directory \"$dir\" writable");

    return $html;

}

function print_assert ($text, $status, $class) {
    return
        "<li class=\"$class\">"
            .str_pad($text, 100, ' ')." $status"
        .'</li>';
}

function resolve_path ($path) {
    $regex = '#/[^/.]+?/\.\.#';
    while (preg_match($regex, $path)) $path = preg_replace($regex, '', $path);
    return $path;
}

function visual_assert ($ok, $text) {
    if ($ok) {
        $status = 'OK';
        $class = 'ok';
    } else {
        $status = 'NOT OK';
        $class = 'not_ok';
    }
    return print_assert($text, $status, $class);
}

$html =
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            .'<title>Install Zvini</title>'
            .'<meta http-equiv="Content-Type"'
            .' content="text/html; charset=UTF-8" />'
            .'<link rel="stylesheet" type="text/css" href="index.css" />'
        .'</head>'
        .'<body>'
            .'<ul style="font-family: monospace; white-space: pre">';

$apacheModules = apache_get_modules();

$ok = in_array('mod_rewrite', $apacheModules);
$html .= visual_assert($ok, 'Apache mod_rewrite enabled');

$ok = in_array('mod_headers', $apacheModules);
$html .= visual_assert($ok, 'Apache mod_headers enabled');

$ok = date_default_timezone_get() === 'UTC';
$html .= visual_assert($ok, 'PHP default timezone set to UTC');

$ok = function_exists('curl_init');
$html .= visual_assert($ok, 'PHP Client URL Library installed');

$ok = function_exists('imagecreatefromstring');
$html .= visual_assert($ok, 'PHP image processing and GD installed');

$ok = function_exists('mysqli_connect');
$html .= visual_assert($ok, 'PHP MySQL improved extension installed');

include_once '../fns/Users/Directory/dir.php';
assert_writable_dir(Users\Directory\dir());

include_once '../lib/mysqli.php';
include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');
if ($users) {
    include_once '../fns/Files/File/dir.php';
    include_once '../fns/ReceivedFiles/File/dir.php';
    include_once '../fns/ReceivedFolderFiles/File/dir.php';
    foreach ($users as $user) {
        $id_users = $user->id_users;
        $html .=
            assert_writable_dir(Files\File\dir($id_users))
            .assert_writable_dir(ReceivedFiles\File\dir($id_users))
            .assert_writable_dir(ReceivedFolderFiles\File\dir($id_users));
    }
}

$files = mysqli_query_object($mysqli, 'select * from files');
if ($files) {
    include_once '../fns/Files/File/path.php';
    foreach ($files as $file) {
        $path = Files\File\path($file->id_users, $file->id_files);
        $html .= assert_readable_file($path);
    }
}

$receivedFiles = mysqli_query_object($mysqli, 'select * from received_files');
if ($receivedFiles) {
    include_once '../fns/ReceivedFiles/File/path.php';
    foreach ($receivedFiles as $receivedFile) {
        $receiver_id_users = $receivedFile->receiver_id_users;
        $path = ReceivedFiles\File\path($receiver_id_users, $receivedFile->id);
        $html .= assert_readable_file($path);
    }
}

$sql = 'select * from received_folder_files';
$receivedFolderFiles = mysqli_query_object($mysqli, $sql);
if ($receivedFolderFiles) {
    include_once '../fns/ReceivedFolderFiles/File/path.php';
    foreach ($receivedFolderFiles as $receivedFolderFile) {
        $id_users = $receivedFolderFile->id_users;
        $id = $receivedFolderFile->id;
        $path = ReceivedFolderFiles\File\path($id_users, $id);
        $html .= assert_readable_file($path);
    }
}

$html .=
            '</ul>'
        .'</body>'
    .'</html>';

header('Content-Type: text/html; charset=UTF-8');
echo $html;
