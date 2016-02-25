<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_calculation($mysqli);

include_once '../fns/request_calculation_params.php';
list($expression, $title, $tags, $tag_names, $value, $error,
    $error_char, $resolved_expression, $depends) = request_calculation_params(
    $mysqli, $user, $errors, $focus, $id);

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
    $values['value'] = $value;
    $values['error'] = $error;
    $values['error_char'] = $error_char;
    $values['resolved_expression'] = $resolved_expression;
    $_SESSION['calculations/edit/send/calculation'] = $values;
    redirect("send/$itemQuery");
}

unset($_SESSION['calculations/edit/values']);

include_once "$fnsDir/Users/Calculations/edit.php";
Users\Calculations\edit($mysqli, $user, $calculation,
    $title, $expression, $tags, $tag_names, $value,
    $error, $error_char, $resolved_expression, $depends, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['calculations/view/messages'] = [$message];
unset($_SESSION['calculations/view/errors']);

redirect("../view/$itemQuery");
