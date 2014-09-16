<?php

function create_content ($id, array $values) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once __DIR__.'/../../../fns/create_form_items.php';
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/Form/hidden.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => "Received Contact #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Edit and Import',
        Page\sessionErrors('contacts/received/edit-and-import/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items('../../../', $values)
            .'<div class="hr"></div>'
            .Form\button('Import Contact')
            .Form\hidden('id', $id)
        .'</form>'
    );
}
