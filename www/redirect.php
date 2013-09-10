<?php

include_once 'fns/request_strings.php';
include_once 'classes/Page.php';
include_once 'lib/user.php';

list($url) = request_strings('url');

$theme = $user ? $user->theme : 'orange';

header('Content-Type: text/html; charset=UTF-8');

$page->echoHtml(
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
    .'</script>'
);
