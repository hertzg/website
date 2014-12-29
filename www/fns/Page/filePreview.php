<?php

namespace Page;

function filePreview ($media_type, $content_type,
    $id, $downloadBase, $base, $revision = '0') {

    $audio = $media_type == 'audio';
    $image = $media_type == 'image';
    $video = $media_type == 'video';

    if ($audio|| $image || $video) {

        $src = "$downloadBase?id=$id&amp;contentType=$content_type&amp;revision=$revision";

        if ($audio) {
            $content = "<audio src=\"$src\" controls=\"controls\" />";
        } elseif ($image) {
            include_once __DIR__.'/../compressed_js_script.php';
            $content =
                '<div class="imageProgress">'
                    ."<img src=\"$src\" />"
                .'</div>'
                .compressed_js_script('imageProgress', $base);
        } else {
            $content = "<video src=\"$src\" controls=\"controls\" />";
        }

        return "<div class=\"preview\">$content</div>";

    }

    return 'Not available';

}
