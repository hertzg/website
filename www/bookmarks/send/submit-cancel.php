<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset(
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/messages']
);

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/itemQuery.php';
redirect('./'.ItemList\itemQuery($id));
