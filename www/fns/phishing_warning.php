<?php

function phishing_warning () {
    include_once __DIR__.'/get_absolute_base.php';
    include_once __DIR__.'/Page/infoText.php';
    return Page\infoText('You are accessing "<code>'
        .get_absolute_base().'</code>". The address in'
        .' your browser\'s address bar should start with it.');
}
