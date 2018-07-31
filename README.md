# Randcam

Randcam is a way to generate randomness from ip cameras.

## Installation

this project use a mongodb database server

- clone this repository
- `composer install`

## Environment variable

- `MONGODB_URI` ex: mongodb://127.0.0.1:27017/randcam

## Cli usage

### import

import all urls in all json files in import directory

`bin/import`

### export

export all urls from databases to export folder

`bin/export`

### add

add a url and check

`bin/add https://httpbin.org/image/png`

### drop

drop all urls from database

`bin/drop`

### random

generate random string from cameras

`bin/random`

### random loop

generate randomness in loop

`bin/random_loop {int}`

## Http api

### get random data

`GET /random`

`GET /random/{length}`

### get all cameras

`GET /cameras`