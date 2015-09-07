<?php

function echo_public_page ($user, $title, $content, $base, $options = []) {
    if ($user) $options['logo_href'] = "{$base}home/";
    include_once __DIR__.'/echo_page.php';
    echo_page($user, $title, $content, $base, $options);
}
