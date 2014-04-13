<?php

namespace Files;

function filePath ($id_users, $id) {
    return __DIR__."/../../users/$id_users/files/$id";
}
