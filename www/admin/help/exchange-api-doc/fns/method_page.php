<?php

function method_page ($methodName, $params, $returns, $errors) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    include_once __DIR__.'/get_methods.php';
    $description = get_methods()[$methodName];

    include_once "$fnsDir/Page/text.php";
    $items = [Page\text("<code>$methodName</code> - $description")];

    if ($params) {
        $text = 'Method parameters:';
        foreach ($params as $param) {
            $text .= "<br /><code>$param[name]</code> - $param[description]";
        }
        $items[] = Page\text($text);
    } else {
        $items[] = Page\text('The method has no parameters.');
    }

    include_once "$fnsDir/ApiDoc/methodResult.php";
    $items[] = ApiDoc\methodResult($returns);

    if ($errors) {
        $text = 'Expected errors:';
        foreach ($errors as $error => $description) {
            $text .= "<br /><code>$error</code> - $description";
        }
    } else {
        $text = 'No errors expected.';
    }
    $items[] = Page\text($text);

    include_once "$fnsDir/Page/create.php";
    $content = Page\create(
        [
            'title' => 'Exchange API Documentation',
            'href' => "../#$methodName",
        ],
        $methodName,
        join('<div class="hr"></div>', $items)
    );

    include_once __DIR__.'/../../../fns/echo_admin_page.php';
    echo_admin_page($user, "$methodName Method", $content, '../../../');

}
