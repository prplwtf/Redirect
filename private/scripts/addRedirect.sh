#!/bin/bash

# REDIRECT NAME        $1
# REDIRECT URL         $2

cp ^#datapath#^/storage/redirect.html ^#datapath#^/storage/redirects/$1;
sed -i "s~redr~$2~g" ^#datapath#^/storage/redirects/$1;
mkdir public/$1;
ln ^#datapath#^/storage/redirects/$1 public/$1/index.html;