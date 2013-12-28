#!/bin/sh
phpunit --bootstrap $(dirname $0)/bootstrap.php $1
