<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($title, $url, $tags) = request_strings('title', 'url', 'tags');

include_once '../../fns/str_collapse_spaces.php';
$title = str_collapse_spaces($title);
$url = str_collapse_spaces($url);
$tags = str_collapse_spaces($tags);

$errors = [];

if ($url === '') $errors[] = 'Enter URL.';

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['bookmarks/edit/errors'] = $errors;
    $_SESSION['bookmarks/edit/values'] = [
        'title' => $title,
        'url' => $url,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['bookmarks/edit/errors'],
    $_SESSION['bookmarks/edit/values']
);

include_once '../../fns/Bookmarks/edit.php';
Bookmarks\edit($mysqli, $id_users, $id, $title, $url, $tags);

include_once '../../fns/BookmarkTags/deleteOnBookmark.php';
BookmarkTags\deleteOnBookmark($mysqli, $id);

include_once '../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $title, $url);

$_SESSION['bookmarks/view/messages'] = ['Changes have been saved.'];
redirect("../view/?id=$id");
