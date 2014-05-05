<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_bookmark_params.php';
list($url, $title, $tags, $tag_names) = request_bookmark_params($errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['bookmarks/edit/errors'] = $errors;
    $_SESSION['bookmarks/edit/values'] = [
        'title' => $title,
        'url' => $url,
        'tags' => $tags,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['bookmarks/edit/errors'],
    $_SESSION['bookmarks/edit/values']
);

include_once '../../fns/Users/Bookmarks/edit.php';
Users\Bookmarks\edit($mysqli, $id_users, $id, $title, $url, $tags, $tag_names);

$_SESSION['bookmarks/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
