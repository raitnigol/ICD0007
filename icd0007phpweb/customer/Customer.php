<?php

class Customer {

    public function __construct(
            public string $firstName,
            public string $lastName,
            public string $code) {
    }
}