<?php

$base = '../';

include_once '../fns/signed_user.php';
$user = signed_user($base);

include_once '../fns/request_strings.php';
list($url) = request_strings('url');

if (!array_key_exists('HTTP_REFERER', $_SERVER)) {
    include_once '../fns/redirect.php';
    redirect($url);
}

$escapedUrl = htmlspecialchars($url);

$body =
    '<div class="page-text">'
        .'<div style="color: #fff">Redirecting to:</div>'
        .'<div>'
            ."<a class=\"a\" href=\"$escapedUrl\">$escapedUrl</a>"
        .'</div>'
    .'</div>'
    .'<script type="text/javascript">'
    .'location = '.json_encode($url)
    .'</script>';

$theme = $user ? $user->theme : 'orange';

include_once '../fns/echo_html.php';
echo_html('Redirecting', '', $body, $theme, $base);
