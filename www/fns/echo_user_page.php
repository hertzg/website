<?php

function echo_user_page ($user, $title, $content, $base, $options = []) {
    $options['logo_href'] = "{$base}home/";
    include_once __DIR__.'/echo_page.php';
    echo_page($user, $title, $content, $base, $options);
}
