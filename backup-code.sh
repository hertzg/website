#!/bin/bash
cd `dirname $BASH_SOURCE`
tar czf backup-code.tgz * --exclude=*.tgz --exclude=www/users/*
