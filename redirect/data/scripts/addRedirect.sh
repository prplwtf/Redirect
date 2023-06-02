#!/bin/bash

# REDIRECT NAME        $1
# REDIRECT URL         $2

mkdir public/$1;
cp ^#datapath#^/storage/redirect.html public/$1/index.html;
sed -i "s~redr~$2~g" public/$1/index.html;

touch ^#datapath#^/storage/redirects/$1;
