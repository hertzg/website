<?php

namespace RecipientList;

function enterCancelForm ($username, array $params) {

    include_once __DIR__.'/../Form/hidden.php';
    $hiddens = '';
    foreach ($params as $key => $value) {
        $hiddens .= \Form\hidden($key, $value);
    }

    include_once __DIR__.'/../Form/button.php';
    include_once __DIR__.'/../Form/textfield.php';
    include_once __DIR__.'/../Page/buttonLink.php';
    include_once __DIR__.'/../Page/staticTwoColumns.php';
    include_once __DIR__.'/../Username/maxLength.php';
    return
        '<form action="submit-add.php" method="post">'
            .\Form\textfield('username', 'Zvini username', [
                'value' => $username,
                'maxlength' => \Username\maxLength(),
                'required' => true,
                'autofocus' => true,
            ])
            .'<div class="hr"></div>'
            .\Page\staticTwoColumns(
                \Form\button('Add Recipient'),
                \Page\buttonLink('Cancel', 'submit-cancel.php?'.htmlspecialchars(http_build_query($params)))
            )
            .$hiddens
        .'</form>';

}
