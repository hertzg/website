<?php

namespace ViewPage;

function create ($note, &$scripts) {

    $id = $note->id;
    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    if ($note->password_protect) {

        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = \Session\EncryptionKey\get();

        if ($encryption_key === null) $text = '****';
        else {

            include_once "$fnsDir/Crypto/decrypt.php";
            $text = \Crypto\decrypt($encryption_key,
                $note->encrypted_text, $note->encrypted_text_iv);

            if ($text === false) $text = '****';

        }

        include_once "$fnsDir/Page/text.php";
        $items = [\Page\text($text)];

    } else {
        $text = $note->text;
        include_once "$fnsDir/create_text_item.php";
        $items = [create_text_item($text, $base)];
    }

    if ($note->num_tags) {
        include_once "$fnsDir/Page/tags.php";
        $items[] = \Page\tags('../', json_decode($note->tags_json));
    }

    include_once "$fnsDir/format_author.php";
    $author = format_author($note->insert_time, $note->insert_api_key_name);
    $infoText =
        ($note->encrypt_in_listings ? 'Encrypted in listings.<br />' : '')
        .($note->password_protect ? 'Password-protected.<br />' : '')
        ."Note created $author.";
    if ($note->revision) {
        $author = format_author($note->update_time, $note->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    unset(
        $_SESSION['notes/edit/errors'],
        $_SESSION['notes/edit/values'],
        $_SESSION['notes/errors'],
        $_SESSION['notes/messages'],
        $_SESSION['notes/send/errors'],
        $_SESSION['notes/send/messages'],
        $_SESSION['notes/send/values'],
        $_SESSION['notes/unlock/errors'],
        $_SESSION['notes/unlock/values']
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
                    'title' => 'Notes',
                    'href' => \ItemList\listHref()."#$id",
                ],
            ],
            "Note #$id",
            \Page\sessionMessages('notes/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Note', '../')
        )
        .optionsPanel($note, $text);

}
