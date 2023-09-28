<?php
function logMessage($message, $logFile = 'auth-service.log') {
    $timestamp = date('Y-m-d H:i:s');
    $userIP = file_get_contents("https://ipinfo.io/ip");
    $logEntry = "[$userIP][$timestamp] message : $message\n";

    $fileHandle = fopen($logFile, 'a');

    if ($fileHandle === false) {
        error_log("Failed to open log file: $logFile");
        return;
    }
    fwrite($fileHandle, $logEntry);
    fclose($fileHandle);
}
?>