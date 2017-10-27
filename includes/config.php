<?php



date_default_timezone_set("Asia/Bangkok");

$config['salt'] = 'jK7d?3';

$config['session_timeout'] = 500000; // seconds

$config['site_name'] = "TKOK";

$config['site_url'] = "http://tkokdesign.com/";

$config['site_domain'] = "tkokdesign.com";



mysqli_report(MYSQLI_REPORT_ERROR);



function is_admin() {

    if ($_SESSION['type'] == '1') {

        return true;

    } else {

        return false;

    }

}

function is_member() {

    if ($_SESSION['type'] == '2') {

        return true;

    } else {

        return false;

    }

}

?>