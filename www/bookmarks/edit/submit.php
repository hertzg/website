<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-bookmark.php';

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

if ($errors) {
    $_SESSION['bookmarks/edit_errors'] = $errors;
    $_SESSION['bookmarks/edit_lastpost'] = array(
        'title' => $title,
        'url' => $url,
        'tags' => $tags,
    );
    redirect("./?id=$id");
}

unset(
    $_SESSION['bookmarks/edit_errors'],
    $_SESSION['bookmarks/edit_lastpost']
);

include_once '../../fns/Bookmarks/edit.php';
include_once '../../lib/mysqli.php';
Bookmarks\edit($mysqli, $idusers, $id, $title, $url, $tags);

include_once '../../classes/BookmarkTags.php';
BookmarkTags::deleteOnBookmark($id);
BookmarkTags::add($idusers, $id, $tagnames, $title, $url);

$_SESSION['bookmarks/view/index_messages'] = array('Changes have been saved.');
redirect("../view/?id=$id");
