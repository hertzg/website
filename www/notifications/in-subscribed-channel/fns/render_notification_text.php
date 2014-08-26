<?php

function render_notification_text ($notification) {
    return
        nl2br(
            preg_replace(
                '#(http://.*?)(\s|$)#',
                '<a class="a" rel="noreferrer" href="$1">$1</a>$2',
                htmlspecialchars($notification->text)
            )
        )
        .'<div style="color: #777; font-size: 12px; line-height: 14px">'
            .date_ago($notification->insert_time)
        .'</div>';
}
