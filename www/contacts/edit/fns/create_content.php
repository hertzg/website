<?php

function create_content ($id, array $values) {

    include_once __DIR__.'/../../../fns/Contacts/maxLengths.php';
    $maxLengths = Contacts\maxLengths();

    include_once __DIR__.'/../../../fns/ItemList/escapedItemQuery.php';
    include_once __DIR__.'/../../../fns/ItemList/listHref.php';
    include_once __DIR__.'/../../../fns/create_tabs.php';
    include_once __DIR__.'/../../../fns/Form/button.php';
    include_once __DIR__.'/../../../fns/Form/checkbox.php';
    include_once __DIR__.'/../../../fns/Form/datefield.php';
    include_once __DIR__.'/../../../fns/Form/hidden.php';
    include_once __DIR__.'/../../../fns/Form/textfield.php';
    include_once __DIR__.'/../../../fns/ItemList/itemHiddenInputs.php';
    include_once __DIR__.'/../../../fns/Page/sessionErrors.php';
    include_once __DIR__.'/../../../fns/Username/maxLength.php';
    return create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => ItemList\listHref(),
            ],
            [
                'title' => "Contact #$id",
                'href' => '../view/'.ItemList\escapedItemQuery($id),
            ],
        ],
        'Edit',
        Page\sessionErrors('contacts/edit/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('full_name', 'Full name', [
                'value' => $values['full_name'],
                'maxlength' => $maxLengths['full_name'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('alias', 'Alias', [
                'value' => $values['alias'],
                'maxlength' => $maxLengths['alias'],
            ])
            .'<div class="hr"></div>'
            .Form\textfield('address', 'Address', [
                'value' => $values['address'],
                'maxlength' => $maxLengths['address'],
            ])
            .'<div class="hr"></div>'
            .Form\textfield('email', 'Email', [
                'value' => $values['email'],
                'maxlength' => $maxLengths['email'],
            ])
            .'<div class="hr"></div>'
            .Form\textfield('phone1', 'Phone 1', [
                'value' => $values['phone1'],
                'maxlength' => $maxLengths['phone1'],
            ])
            .'<div class="hr"></div>'
            .Form\textfield('phone2', 'Phone 2', [
                'value' => $values['phone2'],
                'maxlength' => $maxLengths['phone2'],
            ])
            .'<div class="hr"></div>'
            .Form\datefield([
                'name' => 'birthday_day',
                'value' => $values['birthday_day'],
            ], [
                'name' => 'birthday_month',
                'value' => $values['birthday_month'],
            ], [
                'name' => 'birthday_year',
                'value' => $values['birthday_year'],
            ], 'Birth date', false, true)
            .'<div class="hr"></div>'
            .Form\textfield('username', 'Zvini username', [
                'value' => $values['username'],
                'maxlength' => $maxLengths['username'],
            ])
            .'<div class="hr"></div>'
            .Form\textfield('tags', 'Tags', [
                'value' => $values['tags'],
            ])
            .'<div class="hr"></div>'
            .Form\checkbox('../../', 'favorite',
                'Mark as Favorite', $values['favorite'])
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .ItemList\itemHiddenInputs($id)
        .'</form>'
    );

}
