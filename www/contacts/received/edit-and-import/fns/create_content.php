<?php

function create_content ($id, $values) {

    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
    $itemQuery = ItemList\Received\escapedItemQuery($id);

    include_once __DIR__.'/../../../fns/create_form_items.php';
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/Form/hidden.php";
    include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => "Received Contact #$id",
                    'href' => "../view/$itemQuery",
                ],
            ],
            'Edit and Import',
            Page\sessionErrors('contacts/received/edit-and-import/errors')
            .'<form action="submit.php" method="post">'
                .create_form_items($values)
                .'<div class="hr"></div>'
                .Form\button('Import Contact')
                .ItemList\Received\itemHiddenInputs($id)
            .'</form>'
        )
        .compressed_js_script('flexTextarea', $base)
        .compressed_js_script('formCheckbox', $base);
}
