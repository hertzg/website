<?php

namespace RecipientList;

function enterForm ($username, array $params, $autofocus) {

    include_once __DIR__.'/../Form/hidden.php';
    $hiddens = '';
    foreach ($params as $key => $value) {
        $hiddens .= \Form\hidden($key, $value);
    }

    include_once __DIR__.'/../Form/button.php';
    include_once __DIR__.'/../Form/textfield.php';
    include_once __DIR__.'/../Username/maxLength.php';
    return
        '<form action="submit-add.php" method="post">'
            .\Form\textfield('username', 'Zvini username', [
                'value' => $username,
                'maxlength' => \Username\maxLength(),
                'required' => true,
                'autofocus' => $autofocus,
            ])
            .'<div class="hr"></div>'
            .\Form\button('Add Recipient')
            .$hiddens
        .'</form>';

}
