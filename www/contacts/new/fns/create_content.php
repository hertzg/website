<?php

function create_content ($values, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/create_form_items.php';
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/ItemList/pageHiddenInputs.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    return Page\create(
        [
            'title' => 'Contacts',
            'href' => ItemList\listHref(),
        ],
        'New Contact',
        Page\sessionErrors('contacts/new/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values, $scripts)
            .'<div class="hr"></div>'
            .Page\staticTwoColumns(
                Form\button('Save'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\pageHiddenInputs()
        .'</form>'
    );

}
