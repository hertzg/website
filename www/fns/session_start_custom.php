<?php

function session_start_custom () {
    session_name('zsid');
    session_start();
}
