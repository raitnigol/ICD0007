<?php

require_once 'Customer.php';

function encodeCustomer(Customer $customer): string {
    return sprintf('%s;%s;%s',
        urlencode($customer->firstName),
        urlencode($customer->lastName),
        urlencode($customer->code));
}

function decodeCustomer(string $data): Customer {
    [$firstName, $lastName, $code] = explode(';', $data);

    return new Customer($firstName, $lastName, $code);
}