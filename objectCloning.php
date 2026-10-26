<?php

class Address {
    public function __construct (
        public string $city,
        public string $street
    ) {}
}

class Order {
    public function __construct(
        public int $orderId,
        public Address $address,
        public string $status='pending'
    ) {}

    public function updateStreet (string $street): void {
        $this->address->street = $street;
    }

    public function __clone(): void {
        $this->address = clone $this->address;
    }
}

$address = new Address("Dhaka", "Road 10");
$order1 = new Order(1, $address);
$order2 = clone $order1;

$order2->updateStreet("Road 20");

print_r($order1->address);
print_r($order2->address);