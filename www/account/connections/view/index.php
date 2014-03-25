<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once '../../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../../fns/Connections/get.php';
include_once '../../../lib/mysqli.php';
$connection = Connections\get($mysqli, $user->idusers, $id);

unset(
    $_SESSION['account/connections/index_errors'],
    $_SESSION['account/connections/index_messages']
);

if (!$connection) {
    $_SESSION['account/connections/index_errors'] = [
        'The connection no longer exists.',
    ];
    include_once '../../../fns/redirect.php';
    redirect('..');
}

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Connections',
            'href' => '..',
        ],
    ],
    "Connection #$id",
    Form\label('Username', htmlspecialchars($connection->username))
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Connection #$id", $content, $base);
