<?php

namespace ReceivedFiles;

function filePath ($receiver_id_users, $id) {
    return __DIR__."/../../users/$receiver_id_users/received-files/$id";
}
