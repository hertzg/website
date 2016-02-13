<?php

function compressed_js_script ($name, $base = '') {

    $fullName = "js/$name/compressed.js";

    include_once __DIR__.'/get_revision.php';
    $revision = get_revision($fullName);

    return "<script type=\"text/javascript\" src=\"$base$fullName?$revision\">"
        .'</script>';

}
