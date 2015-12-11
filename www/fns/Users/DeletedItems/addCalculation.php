<?php

namespace Users\DeletedItems;

function addCalculation ($mysqli, $calculation, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $calculation->id_users, 'calculation', [
        'id' => $calculation->id,
        'expression' => $calculation->expression,
        'title' => $calculation->title,
        'tags' => $calculation->tags,
        'value' => $calculation->value,
        'error' => $calculation->error,
        'error_char' => $calculation->error_char,
        'resolved_expression' => $calculation->resolved_expression,
        'insert_api_key_id' => $calculation->insert_api_key_id,
        'insert_time' => $calculation->insert_time,
        'update_api_key_id' => $calculation->update_api_key_id,
        'update_time' => $calculation->update_time,
        'revision' => $calculation->revision,
    ], $apiKey);
}
