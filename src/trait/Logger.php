<?php
trait Logger {
    # This is a example, how logs can be implemented.
    public function logError(string $message): void {
        # Some logging logic here ... 
        echo "<p style='color:red;'>[ERROR] " . date("Y-m-d H:i:s") . " | " . $message . "</p>";
    }
    public function logWarning(string $message): void {
        # Some logging logic here ... 
        echo "<p style='color:orange;'>[WARNING] " . date("Y-m-d H:i:s") . " | " . $message . "</p>";
    }
    public function logInfo(string $message): void {
        # Some logging logic here ...
        echo "<p style='color:blue;'>[INFO] " . date("Y-m-d H:i:s") . " | " . $message . "</p>";
    }
    public function logDebug(string $message): void {
        # Some logging logic here ...
        echo "<p style='color:gray;'>[DEBUG] " . date("Y-m-d H:i:s") . " | " . $message . "</p>";
    }
}