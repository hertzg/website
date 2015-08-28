<?php

namespace ViewPage;

function create ($note, &$scripts) {

    $id = $note->id;
    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    $text_encrypted = false;
    $errors = '';
    if ($note->password_protect) {

        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = \Session\EncryptionKey\get();

        if ($encryption_key === null) {
            $text_encrypted = true;
            include_once __DIR__.'/unlockableOptionsPanel.php';
            $optionsPanel = unlockableOptionsPanel($note);
        } else {

            include_once "$fnsDir/Crypto/decrypt.php";
            $text = \Crypto\decrypt($encryption_key,
                $note->encrypted_text, $note->encrypted_text_iv);

            if ($text === false) {

                $text_encrypted = true;

                include_once __DIR__.'/stuckOptionsPanel.php';
                $optionsPanel = stuckOptionsPanel($note);

                include_once "$fnsDir/Page/errors.php";
                $errors = \Page\errors([
                    'The note can no longer be unlocked'
                    .' as your account password has been reset.',
                ]);

            } else {
                include_once __DIR__.'/optionsPanel.php';
                $optionsPanel = optionsPanel($note, $text);
            }

        }

    } else {
        $text = $note->text;
        include_once __DIR__.'/optionsPanel.php';
        $optionsPanel = optionsPanel($note, $text);
    }

    if ($text_encrypted) {
        include_once "$fnsDir/Page/text.php";
        $item = \Page\text('****');
    } else {
        include_once "$fnsDir/create_text_item.php";
        $item = create_text_item($text, $base);
    }

    $items = [$item];

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

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

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
            $errors.\Page\sessionMessages('notes/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Note', '../')
        )
        .$optionsPanel;

}
