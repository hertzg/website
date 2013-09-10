<?php

include_once 'lib/require-bookmark.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Bookmarks.php';

list($title, $url) = request_strings('title', 'url');

$errors = array();

if (!$url) {
    $errors[] = 'Enter URL.';
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

Bookmarks::edit($idusers, $id, $title, $url);

$_SESSION['bookmarks/view_messages'] = array('Changes have been saved.');
redirect("view.php?id=$id");
