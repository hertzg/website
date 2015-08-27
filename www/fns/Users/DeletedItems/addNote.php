<?php

namespace Users\DeletedItems;

function addNote ($mysqli, $note, $apiKey) {

    $encrypted_text = $note->encrypted_text;
    if ($encrypted_text !== null) $encrypted_text = bin2hex($encrypted_text);

    $encrypted_title = $note->encrypted_title;
    if ($encrypted_title !== null) $encrypted_title = bin2hex($encrypted_title);

    include_once __DIR__.'/add.php';
    add($mysqli, $note->id_users, 'note', [
        'id' => $note->id,
        'text' => $note->text,
        'encrypted_text' => $encrypted_text,
        'encrypted_text_iv' => $note->encrypted_text_iv,
        'title' => $note->title,
        'encrypted_title' => $encrypted_title,
        'encrypted_title_iv' => $note->encrypted_title_iv,
        'tags' => $note->tags,
        'encrypt_in_listings' => $note->encrypt_in_listings,
        'password_protect' => $note->password_protect,
        'insert_api_key_id' => $note->insert_api_key_id,
        'insert_time' => $note->insert_time,
        'update_api_key_id' => $note->update_api_key_id,
        'update_time' => $note->update_time,
        'revision' => $note->revision,
    ], $apiKey);

}
