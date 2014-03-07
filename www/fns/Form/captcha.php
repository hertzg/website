<?php

namespace Form;

function captcha ($base, $autofocus = false) {
    include_once __DIR__.'/../../classes/Captcha.php';
    if (\Captcha::required()) {
        include_once __DIR__.'/../../classes/Form.php';
        return
            '<div class="form-captcha">'
                ."<img src=\"{$base}captcha/\""
                .' style="vertical-align: top"'
                .' alt="CAPTCHA" width="102" height="40" />'
            .'</div>'
            .\Form::textfield('captcha', 'Verification', array(
                'required' => true,
                'autofocus' => $autofocus,
            ))
            .'<div class="hr"></div>';
    }
}
