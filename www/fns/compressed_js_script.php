<?php

function compressed_js_script ($name, $base = '', $class = '') {

    $fullName = "js/$name/compressed.js";

    include_once __DIR__.'/get_revision.php';
    $revision = get_revision($fullName);

    if ($class === '') $classAttribute = '';
    else $classAttribute = " class=\"$class\"";

    return '<script type="text/javascript"'
        ." src=\"$base$fullName?$revision\"$classAttribute>"
        .'</script>';

}
