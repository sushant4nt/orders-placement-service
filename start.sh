#!/usr/bin/env bash

echo "Checking if already containers are running.."

docker-compose down

echo "Starting Docker Containers"

docker-compose up --build
