<?php

include_once 'lib/require-bookmark.php';
include_once '../fns/redirect.php';
include_once '../classes/Bookmarks.php';
Bookmarks::delete($idusers, $id);
$_SESSION['bookmarks/index_messages'] = array('Bookmark has been deleted.');
redirect();
