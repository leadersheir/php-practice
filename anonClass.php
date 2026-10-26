<?php

interface NotificationSender {
    public function send(string $message): bool;
}

function notifyUser (
    NotificationSender $sender,
    string $message
): bool {
    return $sender->send($message);
}

$sender = new class implements NotificationSender {
    private $messages = [];

    public function send(string $message): bool {
        array_push($this->messages, $message);
        return true;
    }

    public function getMessages(): array {
        return $this->messages;
    }
};

notifyUser($sender, "Task created");
notifyUser($sender, "Task completed");

print_r($sender->getMessages());