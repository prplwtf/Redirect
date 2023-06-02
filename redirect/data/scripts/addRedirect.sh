#!/bin/bash

# REDIRECT NAME        $1
# REDIRECT URL         $2

cp ^#datapath#^/storage/redirect.html ^#datapath#^/storage/redirects/$1;
sed -i "s~redr~$2~g" public/r/$1/index.html;

mkdir public/$1;
cp ^#datapath#^/storage/redirects/$1 public/$1/$1.html;
