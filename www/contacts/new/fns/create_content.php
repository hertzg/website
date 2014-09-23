<?php

function create_content ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/create_form_items.php';
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/ItemList/pageHiddenInputs.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Contacts',
                    'href' => ItemList\listHref(),
                ],
            ],
            'New',
            Page\sessionErrors('contacts/new/errors')
            .'<form action="submit.php" method="post">'
                .create_form_items($values)
                .'<div class="hr"></div>'
                .Page\staticTwoColumns(
                    Form\button('Save'),
                    Form\button('Send', 'sendButton')
                )
                .ItemList\pageHiddenInputs()
            .'</form>'
        )
        .compressed_js_script('formCheckbox', '../../');

}
