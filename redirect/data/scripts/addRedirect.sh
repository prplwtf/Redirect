#!/bin/bash

# REDIRECT NAME        $1
# REDIRECT URL         $2

mkdir public/r/$1;
cp ^#datapath#^/storage/redirect.html public/r/$1/index.html;
sed -i "s~redr~$2~g" public/r/$1/index.html;

mkdir public/$1;
cp public/r/$1/index.html public/$1/index.html;
