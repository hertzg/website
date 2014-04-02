<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
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
    $_SESSION['bookmarks/new/errors'] = $errors;
    $_SESSION['bookmarks/new/values'] = [
        'title' => $title,
        'url' => $url,
        'tags' => $tags,
    ];
    redirect();
}

unset(
    $_SESSION['bookmarks/new/errors'],
    $_SESSION['bookmarks/new/values']
);

include_once '../../fns/Bookmarks/add.php';
include_once '../../lib/mysqli.php';
$id = Bookmarks\add($mysqli, $id_users, $url, $title, $tags);

include_once '../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $url, $title);

include_once '../../fns/Users/addNumBookmarks.php';
Users\addNumBookmarks($mysqli, $id_users, 1);

$_SESSION['bookmarks/view/messages'] = ['Bookmark has been saved.'];
redirect("../view/?id=$id");
