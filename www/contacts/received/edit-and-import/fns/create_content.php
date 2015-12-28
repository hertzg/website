<?php

function create_content ($id, $values, &$scripts) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = ItemList\Received\escapedItemQuery($id);

    include_once __DIR__.'/../../../fns/create_form_items.php';
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    return Page\create(
        [
            'title' => "Received Contact #$id",
            'href' => "../view/$itemQuery#edit-and-import",
        ],
        'Edit and Import',
        Page\sessionErrors('contacts/received/edit-and-import/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values, $scripts, '../')
            .'<div class="hr"></div>'
            .Form\button('Import Contact')
            .ItemList\Received\itemHiddenInputs($id)
        .'</form>'
    );
}
