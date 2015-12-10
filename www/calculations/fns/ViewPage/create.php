<?php

namespace ViewPage;

function create ($calculation, &$scripts) {

    $id = $calculation->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../');

    $items = [];

    $title = $calculation->title;
    if ($title !== '') {

        include_once "$fnsDir/request_strings.php";
        list($keyword) = request_strings('keyword');

        include_once "$fnsDir/str_collapse_spaces.php";
        $keyword = str_collapse_spaces($keyword);

        $title = htmlspecialchars($title);

        if ($keyword !== '') {
            $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
        }

        include_once "$fnsDir/Page/text.php";
        $items[] = \Page\text($title);

    }

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('Expression',
        htmlspecialchars($calculation->expression));

    if ($calculation->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags('', json_decode($calculation->tags_json));
    }

    include_once "$fnsDir/calculation_value.php";
    $items[] = calculation_value($calculation);

    include_once "$fnsDir/format_author.php";
    $api_key_name = $calculation->insert_api_key_name;
    $author = format_author($calculation->insert_time, $api_key_name);
    $infoText = "Calculation created $author.";
    if ($calculation->revision) {
        $api_key_name = $calculation->update_api_key_name;
        $author = format_author($calculation->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    unset(
        $_SESSION['calculations/edit/errors'],
        $_SESSION['calculations/edit/values'],
        $_SESSION['calculations/errors'],
        $_SESSION['calculations/messages'],
        $_SESSION['calculations/new/errors'],
        $_SESSION['calculations/new/values'],
        $_SESSION['calculations/send/errors'],
        $_SESSION['calculations/send/messages'],
        $_SESSION['calculations/send/values']
    );

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Calculations',
                    'href' => \ItemList\listHref()."#$id",
                ],
            ],
            "Calculation #$id",
            \Page\sessionMessages('calculations/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Calculation', '../')
        )
        .optionsPanel($calculation);

}
