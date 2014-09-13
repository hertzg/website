<?php

function method_page ($groupName, $prefix,
    $methodName, $description, $params, $errors) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    include_once "$fnsDir/Page/text.php";
    $items = [Page\text("<code>$prefix/$methodName</code> - $description")];

    if ($params) {
        $text = 'Method parameters:';
        foreach ($params as $param) {
            $text .= "<br /><code>$param[name]</code> - $param[description]";
        }
        $items[] = Page\text($text);
    } else {
        $items[] = Page\text('The method has no parameters.');
    }

    if ($errors) {
        $text = 'Expected errors:';
        foreach ($errors as $error => $description) {
            $text .= "<br /><code>$error</code> - $description";
        }
    } else {
        $text = 'No errors expected.';
    }
    $items[] = Page\text($text);

    include_once "$fnsDir/Page/tabs.php";
    $content = Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => $groupName,
                'href' => '..',
            ],
        ],
        $methodName,
        join('<div class="hr"></div>', $items)
    );

    include_once "$fnsDir/echo_page.php";
    echo_page($user, "$prefix/$methodName Method", $content, '../../../../');

}
