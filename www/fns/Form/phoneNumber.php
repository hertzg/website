<?php

namespace Form;

function phoneNumber ($text, $number, $title) {
    $escapedNumber = htmlspecialchars($number);
    include_once __DIR__.'/association.php';
    include_once __DIR__.'/../Page/imageLink.php';
    return association(
        "<div class=\"form-telLink\">"
            .\Page\imageLink($title, "tel:$escapedNumber", 'phone')
        .'</div>'
        ."<a class=\"rightButton clickable\" href=\"sms:$escapedNumber\">"
            .'<span class="rightButton-icon icon send"></span>'
        .'</a>',
        "<label>$text:</label>"
    );
}
