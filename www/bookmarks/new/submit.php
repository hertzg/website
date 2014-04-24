<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_bookmark_params.php';
list($url, $title, $tags, $tag_names) = request_bookmark_params($errors);

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

$_SESSION['bookmarks/view/messages'] = ['Bookmark has been saved.'];
redirect("../view/?id=$id");
