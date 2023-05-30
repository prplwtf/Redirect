#!/bin/bash

# REDIRECT NAME        $1
# REDIRECT URL         $2

cp ^#datapath#^/storage/redirect.html public/r/$1.html;
sed -i "s~redr~$2~g" public/r/$1.html;