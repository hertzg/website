<?php

function method_page ($groupName, $prefix, $methodName, $description, array $params) {

    $base = '../../../../';

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user($base);

    include_once __DIR__.'/../../../fns/Page/text.php';
    $items = [Page\text("<code>$prefix/$methodName</code> - $description")];

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

    include_once __DIR__.'/../../../fns/Page/tabs.php';
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

    include_once __DIR__.'/../../../fns/echo_page.php';
    echo_page($user, "$prefix/$methodName Method", $content, $base);

}
