<?php

require_once 'Customer.php';
require_once 'functions.php';

$data = $argv[1]; // read data from input
                  // data is in the following form: Bob;Taylor;222

$c = null;

// create object out of input data.

print 'Customer info' . PHP_EOL;
print "  First name: $c->firstName" . PHP_EOL;
print "  Last name: $c->lastName" . PHP_EOL;
print "  Code name: $c->code" . PHP_EOL;