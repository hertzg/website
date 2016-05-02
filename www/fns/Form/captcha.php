<?php

namespace Form;

function captcha ($base, $autofocus = false) {

    include_once __DIR__.'/../Captcha/required.php';
    if (!\Captcha\required()) return;

    include_once __DIR__.'/notes.php';
    include_once __DIR__.'/textfield.php';
    return
        '<div class="form-captcha">'
            .'<img alt="CAPTCHA" class="form-captcha-image"'
            ." src=\"{$base}captcha/\" />"
        .'</div>'
        .textfield('captcha', 'Verification', [
            'required' => true,
            'autofocus' => $autofocus,
        ])
        .notes([
            'Enter the characters shown on the image above.',
            'This proves that you are a human and not a robot.',
        ]);

}
