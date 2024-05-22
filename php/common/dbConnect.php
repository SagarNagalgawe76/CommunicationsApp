<?php
$db = new mysqli('localhost', 'root', '', 'dashboard', 3307);

$connectionStatus = $db->connect_error ? 'failed' : 'established';
if ($connectionStatus == 'failed') {
    echo "failed";
}


