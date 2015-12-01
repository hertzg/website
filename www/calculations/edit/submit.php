<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_calculation($mysqli);

include_once '../fns/request_calculation_params.php';
list($expression, $title, $tags,
    $tag_names) = request_calculation_params($errors, $focus);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

$values = [
    'focus' => $focus,
    'title' => $title,
    'expression' => $expression,
    'tags' => $tags,
];

$_SESSION['calculations/edit/values'] = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['calculations/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['calculations/edit/errors']);

include_once "$fnsDir/request_strings.php";
list($sendButton) = request_strings('sendButton');
if ($sendButton) {
    unset(
        $_SESSION['calculations/edit/send/errors'],
        $_SESSION['calculations/edit/send/messages'],
        $_SESSION['calculations/edit/send/values']
    );
    $_SESSION['calculations/edit/send/calculation'] = $values;
    redirect("send/$itemQuery");
}

unset($_SESSION['calculations/edit/values']);

include_once "$fnsDir/Users/Calculations/edit.php";
Users\Calculations\edit($mysqli, $calculation,
    $title, $expression, $tags, $tag_names, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['calculations/view/messages'] = [$message];

redirect("../view/$itemQuery");
