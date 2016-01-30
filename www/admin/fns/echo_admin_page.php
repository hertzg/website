<?php

function echo_admin_page ($user, $title,
    $content, $admin_base, $options = []) {

    $logo_href = $admin_base;
    if ($user) $logo_href .= '../home/';
    $options['logo_href'] = $logo_href;

    include_once __DIR__.'/../../fns/echo_page.php';
    echo_page($user, $title, $content, "$admin_base../", $options);

}
