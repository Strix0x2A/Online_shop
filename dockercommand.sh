#!/bin/bash

function usage() {
    echo "usage: $0 [run_php | run_mysql | go | clean]"
}

PROJECT_NAME=rush00
PHP=php
MYSQL=mysql
IMG="$PROJECT_NAME-$PHP""_img"

case "$1" in
    "")
        usage
        ;;
    "build")
        docker build -t "$IMG" .
        ;;
    "run_php")
        docker run -d --name $PROJECT_NAME-$PHP -p 80:80 -v $PWD/src:/var/www/html -v $PWD/data:/var/www/data $IMG
        ;;
    "run_mysql")
        docker run -d --name $PROJECT_NAME-$MYSQL -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 mysql:5.7
        ;;
    "go")
        "$0" run_php && "$0" run_mysql
        ;;
    "clean")
        docker container rm -f $(docker container ls | awk "/($PROJECT_NAME-$PHP)/{print \$1}")
        docker container rm -f $(docker container ls | awk "/($PROJECT_NAME-$MYSQL)/{print \$1}")
        ;;
    *)
        echo "$1 : invalid command" 1>&2
        usage
        ;;
esac