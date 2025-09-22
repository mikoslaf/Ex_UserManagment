<?php
trait Logger {
    # This is a example, how logs can be implemented.
    public function logError(string $message): void {
        # Some logging logic here ... 
        echo "<script>console.error('[ERROR] " . date("Y-m-d H:i:s") . " | " . $message . "');</script>";
    }
    public function logWarning(string $message): void {
        # Some logging logic here ... 
        echo "<script>console.warn('[WARNING] " . date("Y-m-d H:i:s") . " | " . $message . "');</script>";
    }
    public function logInfo(string $message): void {
        # Some logging logic here ...
        echo "<script>console.info('[INFO] " . date("Y-m-d H:i:s") . " | " . $message . "');</script>";
    }
    public function logDebug(string $message): void {
        # Some logging logic here ...
        echo "<script>console.debug('[DEBUG] " . date("Y-m-d H:i:s") . " | " . $message . "');</script>";
    }
}