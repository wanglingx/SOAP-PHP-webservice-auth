<?php
function logMessage($message, $logFile = 'auth-service.log') {
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] message : $message\n";

    $fileHandle = fopen($logFile, 'a');

    if ($fileHandle === false) {
        error_log("Failed to open log file: $logFile");
        return;
    }
    fwrite($fileHandle, $logEntry);
    fclose($fileHandle);
}
?>