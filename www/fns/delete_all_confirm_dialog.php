<?php

function delete_all_confirm_dialog (&$head, $base = '') {

    include_once __DIR__.'/compressed_css_link.php';
    $head = compressed_css_link('confirmDialog', "$base../");

    include_once __DIR__.'/compressed_js_script.php';
    return
        compressed_js_script('confirmDialog', "$base../")
        .'<script type="text/javascript">'
            .'var deleteAllHref = '.json_encode("{$base}delete-all/submit.php")
        .'</script>'
        ."<script type=\"text/javascript\" src=\"{$base}index.js\"></script>";

}