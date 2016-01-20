<?php

namespace Users\Notes;

function edit ($mysqli, $note, $text, $tags,
    $tag_names, $encrypt_in_listings, $password_protect,
    $encryption_key, &$changed, $updateApiKey = null) {

    $fnsDir = __DIR__.'/../..';
    $tags_same = $note->tags === $tags;

    if (($password_protect || $note->text === $text) && $tags_same &&
        (bool)$note->encrypt_in_listings === $encrypt_in_listings &&
        (bool)$note->password_protect === $password_protect) {

        if (!$password_protect) return;

        include_once "$fnsDir/Crypto/decrypt.php";
        $decrypted_text = \Crypto\decrypt($encryption_key,
            $note->encrypted_text, $note->encrypted_text_iv);

        if ($decrypted_text === $text) return;

    }

    $changed = true;
    $id = $note->id;
    $id_users = $note->id_users;

    include_once "$fnsDir/Notes/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Notes\maxLengths()['title']);

    if ($password_protect) {
        include_once "$fnsDir/Crypto/encrypt.php";
        \Crypto\encrypt($encryption_key, $text,
            $encrypted_text, $encrypted_text_iv);
        \Crypto\encrypt($encryption_key, $title,
            $encrypted_title, $encrypted_title_iv);
        $text = $title = '';
    } else {
        $encrypted_text = $encrypted_text_iv =
            $encrypted_title = $encrypted_title_iv = null;
    }

    $update_time = time();

    include_once "$fnsDir/Notes/edit.php";
    \Notes\edit($mysqli, $id, $text, $encrypted_text,
        $encrypted_text_iv, $title, $encrypted_title,
        $encrypted_title_iv, $tags, $tag_names, $encrypt_in_listings,
        $password_protect, $update_time, $updateApiKey);

    if ($tags_same) {
        if ($tag_names) {
            include_once "$fnsDir/NoteTags/editNote.php";
            \NoteTags\editNote($mysqli, $id, $text, $encrypted_text,
                $encrypted_text_iv, $title, $encrypted_title,
                $encrypted_title_iv, $tags, $tag_names, $encrypt_in_listings,
                $password_protect, $note->insert_time, $update_time);
        }
    } else {

        if ($note->num_tags) {
            include_once "$fnsDir/NoteTags/deleteOnNote.php";
            \NoteTags\deleteOnNote($mysqli, $id);
        }

        if ($tag_names) {
            include_once "$fnsDir/NoteTags/add.php";
            \NoteTags\add($mysqli, $id_users, $id,
                $tag_names, $text, $encrypted_text,
                $encrypted_text_iv, $title, $encrypted_title,
                $encrypted_title_iv, $tags, $encrypt_in_listings,
                $password_protect, $note->insert_time, $update_time);
        }

    }

    if ($note->password_protect && !$password_protect) {
        include_once __DIR__.'/addNumbers.php';
        addNumbers($mysqli, $id_users, 0, -1);
    } else if (!$note->password_protect && $password_protect) {
        include_once __DIR__.'/addNumbers.php';
        addNumbers($mysqli, $id_users, 0, 1);
    }

    include_once "$fnsDir/NoteRevisions/add.php";
    \NoteRevisions\add($mysqli, $id, $id_users, $text,
        $encrypted_text, $encrypted_text_iv, $title, $encrypted_title,
        $encrypted_title_iv, $tags, $encrypt_in_listings,
        $password_protect, $update_time, $note->revision + 1);

}
