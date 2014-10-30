<?php

function echo_guest_page ($title, $content, $base, $options = []) {
    include_once __DIR__.'/echo_page.php';
    echo_page(null, $title, $content, $base, $options);
}
