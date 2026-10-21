<?php

// You're implementing a small ticket-management system. Design two classes: Ticket and PriorityTicket.
// Requirements
// Class: Ticket
// 1. The constructor receives a ticket title.
// 2. The title must be publicly readable.
// 3. Every ticket receives a unique sequential ID, beginning at 1.
// 4. The ID must be private and exposed through getId().
// 5. A protected property $resolved tracks whether the ticket is resolved, initially false.
// 6. Implement resolve() to mark the ticket resolved.
// 7. Implement summary(), returning a formatted description.
// 8. Implement a public static method getTicketCount() returning the total number of tickets created.
// Class: PriorityTicket
// 1. Inherits from Ticket.
// 2. Accepts an additional priority, such as "HIGH" or "LOW".
// 3. Explicitly calls the parent constructor.
// 4. Overrides summary() to prefix the parent's summary with the priority.
// 5. Reuses the parent's implementation rather than duplicating the formatting logic.


class Ticket {
    
    private static $count = 0;
    private $id;
    
    public function __construct(
        public string $title
    ) {
        self::$count++;
        $this->id = self::$count;
    }

    public function getId() {
        return $this->id;
    }

    protected $resolved = false;

    public function resolve () {
        $this->resolved = true;
    }

    public function summary() {
        $resolution = $this->resolved ? 'resolved' : 'unresolved';
        return "Ticket #" . $this->id . ": " . $this->title . " is " . $resolution;
    }

    public static function getTicketCount() {
        return self::$count;
    }
}

class PriorityTicket extends Ticket {
    public function __construct(
        public string $title,
        public string $priority
    ) {
        parent::__construct($title);
    }

    public function summary() {
        return parent::summary() . " | " . $this->priority;
    }
}

$a = new Ticket("Login issue");
$b = new PriorityTicket("Database down", "HIGH");

echo $a->summary() . "\n";
echo $b->summary() . "\n";

$a->resolve();

echo $a->summary() . "\n";

echo Ticket::getTicketCount() . "\n";