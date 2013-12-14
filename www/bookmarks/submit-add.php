<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Bookmarks.php';

list($title, $url, $tags) = request_strings('title', 'url', 'tags');

$errors = array();

if (!$url) {
    $errors[] = 'Enter URL.';
}

unset($_SESSION['bookmarks/add_errors']);

if ($errors) {
    $_SESSION['bookmarks/add_errors'] = $errors;
    redirect('bookmarks/add.php');
}

Bookmarks::add($idusers, $title, $url, $tags);

$_SESSION['bookmarks/index_messages'] = array('Bookmark has been added.');
redirect('index.php');
