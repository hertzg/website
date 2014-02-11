<?php

namespace Tasks;

function delete ($mysqli, $id) {
    mysqli_query($mysqli, "delete from tasks where idtasks = $id");
}
