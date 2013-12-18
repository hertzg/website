<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-bookmark.php';
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

unset($_SESSION['bookmarks/edit_errors']);

if ($errors) {
    $_SESSION['bookmarks/edit_errors'] = $errors;
    $_SESSION['bookmarks/edit_lastpost'] = $_POST;
    redirect("edit.php?id=$id");
}

unset(
    $_SESSION['bookmarks/edit_errors'],
    $_SESSION['bookmarks/edit_lastpost']
);

include_once '../classes/Bookmarks.php';
Bookmarks::edit($idusers, $id, $title, $url, $tags);

include_once '../classes/BookmarkTags.php';
BookmarkTags::deleteOnBookmark($id);
BookmarkTags::add($idusers, $id, $tagnames);

$_SESSION['bookmarks/view_messages'] = array('Changes have been saved.');
redirect("view.php?id=$id");
