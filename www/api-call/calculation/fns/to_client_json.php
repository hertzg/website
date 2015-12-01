<?php

function to_client_json ($calculation) {
    return [
        'id' => (int)$calculation->id,
        'expression' => $calculation->expression,
        'title' => $calculation->title,
        'tags' => $calculation->tags,
        'insert_time' => (int)$calculation->insert_time,
        'update_time' => (int)$calculation->update_time,
    ];
}
