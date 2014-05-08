<?php

namespace Page;

function itemSendForm ($username, $hiddenInputs) {
    include_once __DIR__.'/../Form/button.php';
    include_once __DIR__.'/../Form/textfield.php';
    include_once __DIR__.'/../Username/maxLength.php';
    return
        '<form action="submit.php" method="post">'
            .\Form\textfield('username', 'Zvini username', [
                'value' => $username,
                'maxlength' => \Username\maxLength(),
                'required' => true,
                'autofocus' => true,
            ])
            .'<div class="hr"></div>'
            .\Form\button('Send')
            .$hiddenInputs
        .'</form>';
}
