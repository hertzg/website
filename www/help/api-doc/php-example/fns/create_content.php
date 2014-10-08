<?php

function create_content () {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once __DIR__.'/get_code.php';
    include_once "$fnsDir/Page/phpCode.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/text.php";
    return Page\tabs(
        [
            [
                'title' => 'API Documentation',
                'href' => '..',
            ],
        ],
        'PHP Example',
        Page\text('Below is a PHP code that calls an example API method:')
        .'<div class="hr"></div>'
        .Page\phpCode(get_code())
    );

}
