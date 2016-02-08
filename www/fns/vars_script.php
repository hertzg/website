<?php

function vars_script ($base) {
    include_once __DIR__.'/get_revisions.php';
    include_once __DIR__.'/loader_revisions.php';
    include_once __DIR__.'/Theme/Color/getDefault.php';
    return
        '<script type="text/javascript" class="localNavigation-leave">'
            .'var base = '.json_encode($base)."\n"
            .'var defaultThemeColor = '.json_encode(Theme\Color\getDefault())."\n"
            .'var revisions = '.json_encode(get_revisions())."\n"
            .'var loaderRevisions = '.json_encode(loader_revisions())
        .'</script>';
}
