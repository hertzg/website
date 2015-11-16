<?php

include_once 'fns/require_url.php';
require_url($user, $url);

$text = 'Allow the website at'
    .' "<b>'.htmlspecialchars($url).'</b>" to identify you?';

include_once '../fns/echo_confirm_page.php';
echo_confirm_page('title', $text,
    'Yes, allow', 'submit.php?url='.rawurlencode($url),
    'No, return to home', '../home/', '../');
