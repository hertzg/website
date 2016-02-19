<?php

namespace Page;

function filePreview ($media_type, $content_type, $id,
    $path, $downloadBase, $base, &$scripts, $revision = '0') {

    $audio = $media_type == 'audio';
    $image = $media_type == 'image';
    $video = $media_type == 'video';

    if ($audio|| $image || $video) {

        $src = "$downloadBase?id=$id&amp;contentType=$content_type"
            ."&amp;revision=$revision";

        if ($audio) {
            $content = "<audio src=\"$src\" controls=\"controls\" />";
        } elseif ($image) {

            $content =
                '<div class="imageProgress">'
                    ."<img src=\"$src\" />"
                .'</div>';

            include_once __DIR__.'/../compressed_js_script.php';
            $scripts .= compressed_js_script('imageProgress', $base);

        } else {
            $content = "<video src=\"$src\" controls=\"controls\" />";
        }

        return "<div class=\"preview\">$content</div>";

    }

    if ($media_type == 'text') {

        $lines = '';
        $available = false;
        $f = fopen($path, 'r');
        for ($i = 0; $i < 10; $i++) {
            if (feof($f)) break;
            $line = fgets($f, 256);
            $line = htmlspecialchars($line);
            if ($line === '') {
                $available = false;
                break;
            }
            $available = true;
            $lines .= $line;
        }
        fclose($f);

        if ($available) return "<pre class=\"source_code\">$lines</pre>";

    }

    return 'Not available';

}
