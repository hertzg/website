<?php

function echo_page ($title, $content, $head = '') {

    $content =
        '<h1 class="page-title">'
            .'<img class="page-icon" src="../icons/32.svg" />'
            .'<span class="page-title-text">Zvini Installation Wizard</span>'
        .'</h1>'
        .$content;

    include_once __DIR__.'/echo_html.php';
    echo echo_html($title, $content, $head);

}
