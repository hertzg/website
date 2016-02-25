<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../fns/request_first_stage.php';
list($text, $interval, $tags,
    $tag_names) = request_first_stage($errors, $focus);

include_once '../../fns/redirect.php';

$_SESSION['schedules/new/values'] = [
    'focus' => $focus,
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
];

if ($errors) {
    $_SESSION['schedules/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['schedules/new/errors']);

$_SESSION['schedules/new/next/first_stage'] = [
    'text' => $text,
    'interval' => $interval,
    'tags' => $tags,
    'tag_names' => $tag_names,
];

include_once '../../fns/ItemList/pageQuery.php';
redirect('next/'.ItemList\pageQuery());
