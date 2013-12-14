<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Tags.php';

list($title, $url, $tags) = request_strings('title', 'url', 'tags');

$errors = array();

if (!$url) {
    $errors[] = 'Enter URL.';
}

$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

unset($_SESSION['bookmarks/add_errors']);

if ($errors) {
    $_SESSION['bookmarks/add_errors'] = $errors;
    redirect('add.php');
}

include_once '../classes/Bookmarks.php';
$id = Bookmarks::add($idusers, $title, $url, $tags);

include_once '../classes/BookmarkTags.php';
BookmarkTags::add($idusers, $id, $tagnames);

$_SESSION['bookmarks/index_messages'] = array('Bookmark has been added.');
redirect('index.php');
