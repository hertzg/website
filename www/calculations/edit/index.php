<?php

include_once '../fns/require_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_calculation($mysqli);

$key = 'calculations/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'expression',
        'expression' => $calculation->expression,
        'title' => $calculation->title,
        'tags' => $calculation->tags,
    ];
}

unset(
    $_SESSION['calculations/view/errors'],
    $_SESSION['calculations/view/messages']
);

include_once '../fns/create_form_items.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
$content = Page\create(
    [
        'title' => "Calculation #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('calculations/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save Changes'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, "Edit Calculation #$id", $content, '../../');
