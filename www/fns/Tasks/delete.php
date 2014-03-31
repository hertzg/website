<?php

namespace Tasks;

function delete ($mysqli, $id) {
    $mysqli->query("delete from tasks where id_tasks = $id");
}
