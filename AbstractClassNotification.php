<?php

abstract class Notification {
    public function __construct (
        protected string $message
    ) {}

    protected abstract function format(): string;

    public function send(): string {
        return "Sending: " . $this->format();
    }
}

class EmailNotification extends Notification {
    protected function format(): string {
        return '[Email] ' . $this->message;
    }
}

class SmsNotification extends Notification {
    protected function format(): string {
        return '[SMS] ' . $this->message;
    }
}

$a = new EmailNotification("Welcome");
$b = new SmsNotification("OTP: 1234");

echo $a->send() . "\n";
echo $b->send() . "\n";