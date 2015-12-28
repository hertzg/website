<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'calculations/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../../fns/Calculations/request.php';
    list($expression, $title, $tags) = Calculations\request();

    $values = [
        'focus' => 'expression',
        'expression' => $expression,
        'title' => $title,
        'tags' => $tags,
    ];

}

unset(
    $_SESSION['calculations/errors'],
    $_SESSION['calculations/messages'],
    $_SESSION['calculations/view/errors'],
    $_SESSION['calculations/view/messages'],
    $_SESSION['home/messages']
);

include_once '../fns/create_form_items.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/ItemList/pageHiddenInputs.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/staticTwoColumns.php';
$content = Page\create(
    [
        'title' => 'Calculations',
        'href' => ItemList\listHref(),
    ],
    'New Calculation',
    Page\sessionErrors('calculations/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, 'New Calculation', $content, $base);
