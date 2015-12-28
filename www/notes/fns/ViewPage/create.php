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

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/infoText.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Notes',
                'href' => \ItemList\listHref()."#$id",
            ],
            "Note #$id",
            $errors.\Page\sessionMessages('notes/view/messages')
            .join('<div class="hr"></div>', $items)
            .infoText($note),
            create_new_item_button('Note', '../')
        )
        .$optionsPanel;

}
