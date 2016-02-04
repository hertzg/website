<?php

function combined_js_script ($name, $base = '', $class = '') {

    include_once __DIR__.'/get_revision.php';
    $revision = get_revision("js/$name/compressed.js");

    if ($class === '') $classAttribute = '';
    else $classAttribute = " class=\"$class\"";

    return '<script type="text/javascript" defer="defer"'
        ." src=\"{$base}js/$name/combined.js?$revision\"$classAttribute>"
        .'</script>';

}
