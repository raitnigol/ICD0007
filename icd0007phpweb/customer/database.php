<?php

require_once 'Customer.php';
require_once 'functions.php';

$code = $argv[1]; // read input from parameters

$customer = findCustomerByCode($code);

// transform customer object to compact text form
// so that caller can read the information
// e.g. Bob;Taylor;222
// functions.php contains necessary code.

// print customer info;

function findCustomerByCode(string $code): Customer {
    $filtered = array_filter(getAllCustomers(),
        fn ($each) => $each->code === $code);

    return array_pop($filtered);
}

function getAllCustomers(): array {
    $c1 = new Customer('Alice', 'Smith', '111');
    $c2 = new Customer('Bob', 'Taylor', '222');
    $c3 = new Customer('Carol', 'Adams', '333');

    return [$c1, $c2, $c3];
}