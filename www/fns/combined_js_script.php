<?php

function combined_js_script ($name, $base = '') {

    include_once __DIR__.'/get_revision.php';
    $revision = get_revision("js/$name/compressed.js");

    return '<script type="text/javascript"'
        ." src=\"{$base}js/$name/combined.js?$revision\">"
        .'</script>';

}
