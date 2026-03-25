#!/bin/sh
source /Users/jako/.zensical/bin/activate
zensical build
ghp-import site -p
