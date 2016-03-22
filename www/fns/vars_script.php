<?php

function vars_script ($base, $themeColor, $themeBrightness) {
    include_once __DIR__.'/get_client_revision.php';
    include_once __DIR__.'/get_revisions.php';
    include_once __DIR__.'/loader_revisions.php';
    return
        '<script type="text/javascript">'
            .'var base = '.json_encode($base).','
                .'revisions = '.json_encode(get_revisions()).','
                .'loaderRevisions = '.json_encode(loader_revisions()).','
                .'clientRevision = '.json_encode(get_client_revision()).','
                .'themeColor = '.json_encode($themeColor).','
                .'themeBrightness = '.json_encode($themeBrightness)
        .'</script>';
}
