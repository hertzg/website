<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_received_calculation.php';
include_once '../../../lib/mysqli.php';
list($receivedCalculation, $id, $user) = require_received_calculation($mysqli, '../');

include_once '../../fns/request_calculation_params.php';
list($url, $title, $tags,
    $tag_names) = request_calculation_params($errors, $focus);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['calculations/received/edit-and-import/errors'] = $errors;
    $_SESSION['calculations/received/edit-and-import/values'] = [
        'focus' => $focus,
        'url' => $url,
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

$receivedCalculation->url = $url;
$receivedCalculation->title = $title;
$receivedCalculation->tags = $tags;

include_once "$fnsDir/Users/Calculations/Received/import.php";
Users\Calculations\Received\import($mysqli, $receivedCalculation);

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
redirect('../'.ItemList\Received\listUrl());
