#!/usr/bin/php -q
<?php
require_once(__DIR__ . '/phpagi/phpagi-asmanager.php');

// TimeZone
date_default_timezone_set('America/Bogota');

// Execution Timeout
set_time_limit(20);

// New AMI Object 
$astman = new AGI_AsteriskManager();

// Manager Credentials
$host = '127.0.0.1';
$user = 'manageruser';
$password = 'managerpass';

// Manager Connection 
if (!$astman->connect("{$host}", "{$user}", "{$password}")) {
    echo "Asterisk Manager : Connection Failed\n";

} else {
    echo "Asterisk Manager : Connection Success\n";

    /**
     * Originate
     * - Make Outgoing Call : 54101234567 in context 'OutCalls'
     * If Call is Success & Answered
     * - Connect Call with : Dialplan 'IncomingSample,s,1'
     */
    $output = $astman->Originate("Local/54101234567@OutCalls", "s", "IncomingSample", "1");
    $astman->disconnect();
    if (strtoupper($output["Response"]) != "ERROR") {
        echo "Success\n";
    } else {
        echo "Error\n";
    }
}
?>