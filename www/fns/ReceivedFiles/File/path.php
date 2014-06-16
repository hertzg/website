<?php

namespace ReceivedFiles\File;

function path ($receiver_id_users, $id) {
    return __DIR__."/../../../users/$receiver_id_users/received-files/$id";
}
