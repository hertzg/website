<?php

function create_content ($base, $id, array $values) {

    include_once __DIR__.'/../../../../fns/Contacts/maxLengths.php';
    $maxLengths = Contacts\maxLengths();

    include_once __DIR__.'/../../../../fns/create_tabs.php';
    include_once __DIR__.'/../../../../fns/Form/button.php';
    include_once __DIR__.'/../../../../fns/Form/checkbox.php';
    include_once __DIR__.'/../../../../fns/Form/datefield.php';
    include_once __DIR__.'/../../../../fns/Form/hidden.php';
    include_once __DIR__.'/../../../../fns/Form/textfield.php';
    include_once __DIR__.'/../../../../fns/Page/sessionErrors.php';
    return create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ],
            [
                'title' => "Received Contact #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Edit and Import',
        Page\sessionErrors('contacts/received/edit-and-import/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('full_name', 'Full name', [
                'value' => $values['full_name'],
                'maxlength' => $maxLengths['full_name'],
                'required' => true,
                'autofocus' => true,
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
                'maxlength' => $maxLengths['tags'],
            ])
            .'<div class="hr"></div>'
            .Form\checkbox($base, 'favorite',
                'Mark as Favorite', $values['favorite'])
            .'<div class="hr"></div>'
            .Form\button('Import Contact')
            .Form\hidden('id', $id)
        .'</form>'
    );
}
