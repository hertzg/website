<?php

namespace Users\Notes;

function edit ($mysqli, $note, $text, $tags,
    $tag_names, $encrypt_in_listings, $password_protect,
    $encryption_key, $updateApiKey = null) {

    $id = $note->id;
    $fnsDir = __DIR__.'/../..';

    if ($password_protect) {
        include_once "$fnsDir/Crypto/encrypt.php";
        \Crypto\encrypt($encryption_key, $text,
            $encrypted_text, $encrypted_text_iv);
        $text = '';
    } else {
        $encrypted_text = $encrypted_text_iv = null;
    }

    include_once "$fnsDir/Notes/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Notes\maxLengths()['title']);

    include_once "$fnsDir/Notes/edit.php";
    \Notes\edit($mysqli, $id, $text, $encrypted_text,
        $encrypted_text_iv, $title, $tags, $tag_names,
        $encrypt_in_listings, $password_protect, $updateApiKey);

    if ($note->num_tags) {
        include_once "$fnsDir/NoteTags/deleteOnNote.php";
        \NoteTags\deleteOnNote($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/NoteTags/add.php";
        \NoteTags\add($mysqli, $note->id_users, $id, $tag_names,
            $text, $encrypted_text, $encrypted_text_iv, $title,
            $title, $tags, $encrypt_in_listings, $password_protect);
    }

}
