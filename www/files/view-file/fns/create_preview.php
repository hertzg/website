<?php

function create_preview ($file) {
    if (preg_match('/\.(bmp|gif|jpe?g|png|svg)$/i', $file->filename)) {
        return
            '<div class="preview">'
                ."<img src=\"../download-file/?id=$file->idfiles\" />"
            .'</div>';
    }
    return 'Not available';
}
