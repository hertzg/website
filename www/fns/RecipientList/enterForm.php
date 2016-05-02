<?php

namespace RecipientList;

function enterForm ($username, $params, $autofocus, $base = '') {

    include_once __DIR__.'/../Form/hidden.php';
    $hiddens = '';
    foreach ($params as $key => $value) {
        $hiddens .= \Form\hidden($key, $value);
    }

    include_once __DIR__.'/../Form/button.php';
    include_once __DIR__.'/../Form/textfield.php';
    include_once __DIR__.'/../UsernameAddress/maxLength.php';
    return
        "<form action=\"{$base}submit-add.php\" method=\"post\">"
            .\Form\textfield('username', 'Zvini username', [
                'value' => $username,
                'maxlength' => \UsernameAddress\maxLength(),
                'required' => true,
                'autofocus' => $autofocus,
            ])
            .\Form\button('Add Recipient')
            .$hiddens
        .'</form>';

}
