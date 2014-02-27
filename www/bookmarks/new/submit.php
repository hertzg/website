<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

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
    $_SESSION['bookmarks/new/index_errors'] = $errors;
    $_SESSION['bookmarks/new/index_lastpost'] = array(
        'title' => $title,
        'url' => $url,
        'tags' => $tags,
    );
    redirect();
}

unset(
    $_SESSION['bookmarks/new/index_errors'],
    $_SESSION['bookmarks/new/index_lastpost']
);

include_once '../../fns/Bookmarks/add.php';
include_once '../../lib/mysqli.php';
$id = Bookmarks\add($mysqli, $idusers, $title, $url, $tags);

include_once '../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $idusers, $id, $tagnames, $title, $url);

include_once '../../fns/Users/addNumBookmarks.php';
Users\addNumBookmarks($mysqli, $idusers, 1);

$_SESSION['bookmarks/view/index_messages'] = array('Bookmark has been saved.');
redirect("../view/?id=$id");
