<?php

namespace Users\Notes;

function add ($mysqli, $id_users, $text, $tags,
    $tag_names, $encrypt_in_listings, $password_protect,
    $encryption_key, $insertApiKey = null) {

    $fnsDir = __DIR__.'/../..';

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

    $insert_time = $update_time = time();

    include_once "$fnsDir/Notes/add.php";
    $id = \Notes\add($mysqli, $id_users, $text,
        $encrypted_text, $encrypted_text_iv, $title,
        $encrypted_title, $encrypted_title_iv, $tags,
        $tag_names, $encrypt_in_listings, $password_protect,
        $insert_time, $update_time, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/NoteTags/add.php";
        \NoteTags\add($mysqli, $id_users, $id,
            $tag_names, $text, $encrypted_text,
            $encrypted_text_iv, $title, $encrypted_title,
            $encrypted_title_iv, $tags, $encrypt_in_listings,
            $password_protect, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, 1, $password_protect ? 1 : 0);

    return $id;

}
