<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Tags.php';

list($title, $url, $tags) = request_strings('title', 'url', 'tags');

$title = str_collapse_spaces($title);
$url = str_collapse_spaces($url);
$tags = str_collapse_spaces($tags);

$errors = array();

if ($url === '') $errors[] = 'Enter URL.';

$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

if ($errors) {
    $_SESSION['bookmarks/add_errors'] = $errors;
    $_SESSION['bookmarks/add_lastpost'] = array(
        'title' => $title,
        'url' => $url,
        'tags' => $tags,
    );
    redirect('add.php');
}

unset(
    $_SESSION['bookmarks/add_errors'],
    $_SESSION['bookmarks/add_lastpost']
);

include_once '../classes/Bookmarks.php';
$id = Bookmarks::add($idusers, $title, $url, $tags);

include_once '../classes/BookmarkTags.php';
BookmarkTags::add($idusers, $id, $tagnames);

$_SESSION['bookmarks/view_messages'] = array('Bookmark has been saved.');
redirect("view.php?id=$id");
