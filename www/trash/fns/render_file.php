<?php

function render_file ($file, $description, $href, &$items) {

    $media_type = $file->media_type;
    if ($media_type == 'audio') $icon = 'audio-file';
    elseif ($media_type == 'image') $icon = 'image-file';
    elseif ($media_type == 'video') $icon = 'video-file';
    else $icon = 'file';

    $title = htmlspecialchars($file->name);
    $items[] = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon);

}
