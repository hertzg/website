<?php

namespace Tasks;

function delete ($mysqli, $id) {
    $mysqli->query("delete from tasks where idtasks = $id");
}
