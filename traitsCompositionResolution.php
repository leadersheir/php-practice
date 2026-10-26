<?php

trait ActivityLogger {
    public function log (string $message): string {
        return "[ACTIVITY] " . $message;
    }
}

trait SecurityLogger {
    public function log (string $message): string {
        return "[SECURITY] " . $message;
    }
}

trait IdentifiableLogger {
    
    public abstract function getId(): int;

    public function logWithId(string $message): string {
        return "[" . $this->getId() . "] " . $message;
    }
}

class UserAccount {
    use ActivityLogger, SecurityLogger, IdentifiableLogger {
        SecurityLogger::log insteadof ActivityLogger;
        ActivityLogger::log as logActivity;
    }

    public function __construct (
        private int $id
    ) {}

    public function getId(): int {
        return $this->id;
    }
}

$user = new UserAccount(7);

echo $user->log("Login") . "\n";
echo $user->logActivity("Updated profile") . "\n";
echo $user->logWithId("Account created") . "\n";