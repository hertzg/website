<?php

include_once '../../lib/defaults.php';

include_once '../fns/request_valid_token.php';
include_once '../lib/mysqli.php';
$token = request_valid_token($mysqli, $_GET);

if ($token) {

    include_once '../fns/Cookie/set.php';
    \Cookie\set('token', bin2hex($token->token_text));
    \Cookie\set('username', $token->username);

    include_once '../fns/redirect.php';
    redirect('../home/');

}

include_once '../fns/echo_alert_page.php';
echo_alert_page('Link Invalid', 'The link is no longer valid.'
    .' You should sign in and remember the session to obtain a new link.',
    '..', '../');
