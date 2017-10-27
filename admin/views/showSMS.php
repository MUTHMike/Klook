<?php
if (isset($_GET["sms"])) {
    echo '<div id="msg_status" class="sms label label-warning">';
    echo str_replace('_', ' ', ucwords($_GET["sms"])) . " Id = " . $_GET["id"];
    echo '</div>';
    echo '<div style="display: none" id="js_show" class="sms label label-warning"></div>';
} else {
    echo '<div style="display: none" id="js_show" class="sms label label-warning"></div>';
}
?>