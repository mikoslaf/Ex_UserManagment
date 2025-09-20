<?php

trait Logger {
    # This is a example, how logs can be implemented.
    public function error(string $message): void {
        # Some logging logic here ... 
        echo "[ERROR] " . date("Y-m-d H:i:s") . " | " . $message;
    }
    public function warning(string $message): void {
        # Some logging logic here ... 
        echo "[WARNING] " . date("Y-m-d H:i:s") . " | " . $message;
    }
    public function info(string $message): void {
        # Some logging logic here ...
        echo "[INFO] " . date("Y-m-d H:i:s") . " | " . $message;
    }
    public function debug(string $message): void {
        # Some logging logic here ...
        echo "[DEBUG] " . date("Y-m-d H:i:s") . " | " . $message;
    }
}