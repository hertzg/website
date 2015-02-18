<?php

function create_content ($user, $id, $values) {

    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/create_form_items.php';
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/Form/hidden.php";
    include_once "$fnsDir/ItemList/itemHiddenInputs.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => "Task #$id",
                    'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
                ],
            ],
            'Edit',
            Page\sessionErrors('tasks/edit/errors')
            .'<form action="submit.php" method="post">'
                .create_form_items($user, $values)
                .'<div class="hr"></div>'
                .Page\staticTwoColumns(
                    Form\button('Save Changes'),
                    Form\button('Send', 'sendButton')
                )
                .ItemList\itemHiddenInputs($id)
            .'</form>'
        )
        .compressed_js_script('flexTextarea', $base)
        .compressed_js_script('formCheckbox', $base);

}
