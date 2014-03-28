<?php

function echo_guest_page ($title, $content, $base, array $options = []) {
    include_once __DIR__.'/echo_page.php';
    $options['hideSignOutLink'] = true;
    echo_page(null, $title, $content, $base, $options);
}
