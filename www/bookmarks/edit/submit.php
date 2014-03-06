<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

include_once '../../fns/request_strings.php';
list($title, $url, $tags) = request_strings('title', 'url', 'tags');

include_once '../../fns/str_collapse_spaces.php';
$title = str_collapse_spaces($title);
$url = str_collapse_spaces($url);
$tags = str_collapse_spaces($tags);

$errors = array();

if ($url === '') $errors[] = 'Enter URL.';

include_once '../../classes/Tags.php';
$tagnames = Tags::parse($tags);

if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['bookmarks/edit/index_errors'] = $errors;
    $_SESSION['bookmarks/edit/index_lastpost'] = array(
        'title' => $title,
        'url' => $url,
        'tags' => $tags,
    );
    redirect("./?id=$id");
}

unset(
    $_SESSION['bookmarks/edit/index_errors'],
    $_SESSION['bookmarks/edit/index_lastpost']
);

include_once '../../fns/Bookmarks/edit.php';
Bookmarks\edit($mysqli, $idusers, $id, $title, $url, $tags);

include_once '../../fns/BookmarkTags/deleteOnBookmark.php';
BookmarkTags\deleteOnBookmark($mysqli, $id);

include_once '../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $idusers, $id, $tagnames, $title, $url);

$_SESSION['bookmarks/view/index_messages'] = array('Changes have been saved.');
redirect("../view/?id=$id");
