<?php

namespace TaskTags;

function deleteOnTask ($mysqli, $idtasks) {
    mysqli_query($mysqli, "delete from tasktags where idtasks = $idtasks");
}
