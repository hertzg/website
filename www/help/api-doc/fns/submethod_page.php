<?php

function submethod_page ($groupKey, $subgroupName, $subgroupKey, $methodName,
    $description, array $params, array $errors) {

    $base = '../../../../../';

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user($base);

    $methodFullName = "$groupKey/$subgroupKey/$methodName";

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items = [Page\text("<code>$methodFullName</code> - $description")];

    if ($params) {
        $text = 'Method parameters: ';
        foreach ($params as $param) {
            $text .=
                '<div>'
                    ."<code>$param[name]</code> - $param[description]"
                .'</div>';
        }
        $items[] = Page\text($text);
    } else {
        $items[] = Page\text('The method has no parameters.');
    }

    if ($errors) {
        $text = 'Expected errors: ';
        foreach ($errors as $error) {
            $text .= "<br /><code>$error</code>";
        }
    } else {
        $text = 'No errors expected.';
    }
    $items[] = Page\text($text);

    include_once __DIR__.'/../../../fns/Page/tabs.php';
    $content = Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => $subgroupName,
                'href' => '..',
            ],
        ],
        $methodName,
        join('<div class="hr"></div>', $items)
    );

    include_once __DIR__.'/../../../fns/echo_page.php';
    echo_page($user, "$methodFullName Method", $content, $base);

}
