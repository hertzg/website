<?php

function echo_page ($title, $content, $head = '') {

    include_once __DIR__.'/../../fns/get_revision.php';
    $logoSrc = '../../themes/orange/images/zvini.svg?'
        .get_revision('themes/orange/images/zvini.svg');

    $content =
        '<div class="page-title">'
            ."<img src=\"$logoSrc\" class=\"page-icon\" alt=\"Zvini\" />"
            .'<h1 class="page-title-text">Installation Wizard</h1>'
        .'</div>'
        .$content;

    include_once __DIR__.'/echo_html.php';
    echo echo_html($title, $content, $head);

}
