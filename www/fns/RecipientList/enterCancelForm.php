<?php

namespace RecipientList;

function enterCancelForm ($username, $params) {

    $fnsDir = __DIR__.'/..';

    $hiddens = '';
    $cancelHref = 'submit-cancel.php';
    if ($params) {
        include_once "$fnsDir/Form/hidden.php";
        foreach ($params as $key => $value) {
            $hiddens .= \Form\hidden($key, $value);
        }
        $cancelHref .= '?'.htmlspecialchars(http_build_query($params));
    }

    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Page/buttonLink.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/UsernameAddress/maxLength.php";
    return
        '<form action="submit-add.php" method="post">'
            .\Form\textfield('username', 'Zvini username', [
                'value' => $username,
                'maxlength' => \UsernameAddress\maxLength(),
                'required' => true,
                'autofocus' => true,
            ])
            .\Page\staticTwoColumns(
                \Form\button('Add Recipient'),
                \Page\buttonLink('Cancel', $cancelHref)
            )
            .$hiddens
        .'</form>';

}
