<?php

namespace TaskTags;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from tasktags where idusers = $idusers");
}
