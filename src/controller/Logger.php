<?php

trait Logger {
    # This is a example, how logs can be implemented.
    public function logError(string $message): void {
        # Some logging logic here ... 
        echo "[ERROR] " . date("Y-m-d H:i:s") . " | " . $message;
    }
    public function logWarning(string $message): void {
        # Some logging logic here ... 
        echo "[WARNING] " . date("Y-m-d H:i:s") . " | " . $message;
    }
    public function logInfo(string $message): void {
        # Some logging logic here ...
        echo "[INFO] " . date("Y-m-d H:i:s") . " | " . $message;
    }
    public function logDebug(string $message): void {
        # Some logging logic here ...
        echo "[DEBUG] " . date("Y-m-d H:i:s") . " | " . $message;
    }
}