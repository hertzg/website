<?php

function remove_dialog ($user, &$head, $base = '') {

    if (!$user->num_bookmarks) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', "$base../");

    include_once "$fnsDir/compressed_js_script.php";
    return
        compressed_js_script('confirmDialog', "$base../")
        .'<script type="text/javascript">'
            .'var deleteAllHref = '.json_encode("{$base}delete-all/submit.php")
        .'</script>'
        ."<script type=\"text/javascript\" src=\"{$base}index.js\"></script>";

}
