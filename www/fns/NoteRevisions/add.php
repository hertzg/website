<?php

namespace NoteRevisions;

function add ($mysqli, $id_notes, $id_users, $text, $encrypted_text,
    $encrypted_text_iv, $title, $encrypted_title, $encrypted_title_iv, $tags,
    $encrypt_in_listings, $password_protect, $insert_time, $revision) {

    $text = $mysqli->real_escape_string($text);
    // TODO join ifs
    if ($encrypted_text === null) {
        $encrypted_text = $encrypted_text_iv = 'null';
    } else {
        $encrypted_text = "'".$mysqli->real_escape_string($encrypted_text)."'";
    }
    $title = $mysqli->real_escape_string($title);
    if ($encrypted_title === null) {
        $encrypted_title = $encrypted_title_iv = 'null';
    } else {
        $encrypted_title = $mysqli->real_escape_string($encrypted_title);
        $encrypted_title = "'$encrypted_title'";
    }
    $tags = $mysqli->real_escape_string($tags);
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $password_protect = $password_protect ? '1' : '0';

    $sql = 'insert into note_revisions'
        .' (id_notes, id_users, text, encrypted_text,'
        .' encrypted_text_iv, title, encrypted_title,'
        .' encrypted_title_iv, tags, encrypt_in_listings,'
        .' password_protect, insert_time, revision)'
        ." values ($id_notes, $id_users, '$text', $encrypted_text,"
        ." $encrypted_text_iv, '$title', $encrypted_title,"
        ." '$encrypted_title_iv', '$tags', $encrypt_in_listings,"
        ." $password_protect, $insert_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
