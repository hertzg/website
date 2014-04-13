<?php

function create_preview ($receivedFile) {

    $extension = pathinfo($receivedFile->file_name, PATHINFO_EXTENSION);
    $extension = strtolower($extension);

    $imageRegex = 'bmp|gif|jpe?g|png|svg';
    $videoRegex = 'mp4|ogg|ogv';
    $audioRegex = 'flac|mp3|oga|wav';
    if (preg_match("/^($audioRegex|$imageRegex|$videoRegex)$/", $extension)) {

        include_once __DIR__.'/../../../fns/get_extension_content_type.php';
        $contentType = get_extension_content_type($extension);

        $contentType = rawurlencode($contentType);
        $src = "../download/?id=$receivedFile->id&amp;contentType=$contentType";

        $html = '<div class="preview">';
        if (preg_match("/^($audioRegex)$/", $extension)) {
            $html .= "<audio src=\"$src\" controls=\"controls\" />";;
        } elseif (preg_match("/^($imageRegex)$/", $extension)) {
            $html .= "<img src=\"$src\" />";;
        } else {
            $html .= "<video src=\"$src\" controls=\"controls\" />";;
        }
        $html .= '</div>';
        return $html;

    }
    return 'Not available';

}
