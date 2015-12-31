<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_received_calculation.php';
include_once '../../../lib/mysqli.php';
list($receivedCalculation, $id, $user) = require_received_calculation(
    $mysqli, '../');

include_once '../../fns/request_calculation_params.php';
list($expression, $title, $tags, $tag_names, $value, $error,
    $error_char, $resolved_expression, $depends) = request_calculation_params(
    $mysqli, $user, $errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['calculations/received/edit-and-import/errors'] = $errors;
    $_SESSION['calculations/received/edit-and-import/values'] = [
        'focus' => $focus,
        'expression' => $expression,
        'title' => $title,
        'tags' => $tags,
    ];
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset(
    $_SESSION['calculations/received/edit-and-import/errors'],
    $_SESSION['calculations/received/edit-and-import/values']
);

$receivedCalculation->expression = $expression;
$receivedCalculation->title = $title;
$receivedCalculation->tags = $tags;
$receivedCalculation->value = $value;
$receivedCalculation->error = $error;
$receivedCalculation->error_char = $error_char;

include_once "$fnsDir/Users/Calculations/Received/import.php";
Users\Calculations\Received\import($mysqli, $receivedCalculation, $depends);

$messages = ['Calculation has been imported.'];

if ($user->num_received_calculations == 1) {
    $messages[] = 'No more received calculations.';
    $_SESSION['calculations/messages'] = $messages;
    unset($_SESSION['calculations/errors']);
    redirect('../..');
}

unset($_SESSION['calculations/received/errors']);
$_SESSION['calculations/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
