#!/bin/bash

rm ^#datapath#^/storage/redirects/hello.txt;
chown -R www-data:www-data /var/www/pterodactyl/.blueprint/data/extensions/redirect/*;
