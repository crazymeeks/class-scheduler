#!/bin/bash

DB_DRIVER=sqlite_testing ./vendor/bin/phpunit --testsuite=Integration --filter RoomManagementTest