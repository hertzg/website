<?php

include_once '../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($url) = request_strings('url');

if (!array_key_exists('HTTP_REFERER', $_SERVER)) {
    include_once '../fns/redirect.php';
    redirect($url);
}

$body =
    '<div class="page-text">'
        .'<div>Redirecting to:</div>'
        .'<div>'
            .'<a class="a" href="'.htmlspecialchars($url).'">'
                .htmlspecialchars($url)
            .'</a>'
        .'</div>'
    .'</div>'
    .'<script type="text/javascript">'
    .'location = '.json_encode($url)
    .'</script>';

include_once '../fns/echo_html.php';
echo_html('Redirecting', '', $body, $user->theme, '../');
