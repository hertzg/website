<?php

namespace Users\Notes;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $text = $data->text;
    $encrypted_text = $data->encrypted_text;
    if ($encrypted_text !== null) $encrypted_text = hex2bin($encrypted_text);
    $encrypted_text_iv = $data->encrypted_text_iv;
    $title = $data->title;
    $encrypted_title = $data->encrypted_title;
    if ($encrypted_title !== null) $encrypted_title = hex2bin($encrypted_title);
    $encrypted_title_iv = $data->encrypted_title_iv;
    $tags = $data->tags;
    $encrypt_in_listings = $data->encrypt_in_listings;
    $password_protect = $data->password_protect;
    $insert_time = $data->insert_time;
    $update_time = $data->update_time;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Notes/addDeleted.php";
    \Notes\addDeleted($mysqli, $id, $id_users,
        $text, $encrypted_text, $encrypted_text_iv,
        $title, $encrypted_title, $encrypted_title_iv,
        $tags, $tag_names, $encrypt_in_listings, $password_protect,
        $insert_time, $update_time, $data->revision);

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

}
