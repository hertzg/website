<?php

function echo_admin_page ($user, $title,
    $content, $admin_base, $options = []) {

    $options['logo_href'] = $admin_base;

    include_once __DIR__.'/../../fns/echo_page.php';
    echo_page($user, $title, $content, "$admin_base../", $options);

}
