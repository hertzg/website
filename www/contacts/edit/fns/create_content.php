<?php

function create_content ($id, $values, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/create_form_items.php';
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/ItemList/itemHiddenInputs.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    return Page\create(
        [
            'title' => "Contact #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
        ],
        'Edit',
        Page\sessionErrors('contacts/edit/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values, $scripts)
            .Page\staticTwoColumns(
                Form\button('Save Changes'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    );

}
