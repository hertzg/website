<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../fns/request_calculation_params.php';
list($url, $title, $tags,
    $tag_names) = request_calculation_params($errors, $focus);

$values = [
    'focus' => $focus,
    'title' => $title,
    'url' => $url,
    'tags' => $tags,
];

$_SESSION['calculations/new/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['calculations/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['calculations/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['calculations/new/send/calculation'] = $values;
    unset(
        $_SESSION['calculations/new/send/errors'],
        $_SESSION['calculations/new/send/messages'],
        $_SESSION['calculations/new/send/values']
    );
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('send/'.ItemList\pageQuery());
}

unset($_SESSION['calculations/new/values']);

include_once '../../fns/Users/Calculations/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Calculations\add($mysqli,
    $user->id_users, $url, $title, $tags, $tag_names);

$_SESSION['calculations/view/messages'] = ['Calculation has been saved.'];

include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($id));
