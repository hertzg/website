<?php

function submethod_page ($groupKey, $subgroupName,
    $subgroupKey, $methodName, $description, $params, $returns, $errors) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    $methodFullName = "$groupKey/$subgroupKey/$methodName";

    include_once "$fnsDir/Page/text.php";
    $items = [Page\text("<code>$methodFullName</code> - $description")];

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

    include_once "$fnsDir/Page/tabs.php";
    $content = Page\tabs(
        [
            [
                'title' => $subgroupName,
                'href' => "../#$methodName",
            ],
        ],
        $methodName,
        join('<div class="hr"></div>', $items)
    );

    include_once "$fnsDir/echo_public_page.php";
    echo_public_page($user, "$methodFullName Method", $content,
        '../../../../../');

}
