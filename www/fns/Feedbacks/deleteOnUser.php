<?php

namespace Feedbacks;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from feedbacks where idusers = $idusers");
}
