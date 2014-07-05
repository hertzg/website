<?php

namespace Page;

function filePreview ($media_type, $content_type, $id, $downloadBase) {

    $audio = $media_type == 'audio';
    $image = $media_type == 'image';
    $video = $media_type == 'video';

    if ($audio|| $image || $video) {

        $src = "$downloadBase?id=$id&amp;contentType=$content_type";

        $html = '<div class="preview">';
        if ($audio) $html .= "<audio src=\"$src\" controls=\"controls\" />";
        elseif ($image) $html .= "<img src=\"$src\" />";
        else $html .= "<video src=\"$src\" controls=\"controls\" />";
        $html .= '</div>';
        return $html;

    }

    return 'Not available';

}
