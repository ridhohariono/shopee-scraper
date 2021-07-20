## Shopee Scraper
![Alt text](/Screenshot_4.png?raw=true "Shopee Scraper")

## Installation
- ```git clone https://github.com/ridhohariono/shopee-scraper/```
- ```composer install```
- setting .env file 
- ``` php artisan migrate:refresh --seed ```
- ``` php artisan serve ```

## Listen Queue
Please run this command to listen queue and runing jobs in background or you can make cron job on your local machine
- Open terminal 1 and go to project directory and run ``` php artisan queue:listen --timeout=0 --queue=scrape ```
- Open terminal 2 and go to project directory and run ``` php artisan queue:listen --timeout=0 --queue=insert ```

## Run the Scraper
### Web version
 - Go to localhost:[YOUR_PORT]/login
 - email ```admin@admin.com``` password ```admin1122```
 - input multiple keywords on keyword input field and submit
 - Scraper will runing in the background

### Command Line Version
 - Open Terminal and go to project directory
 - Run ``` php artisan product:scrape [keyword1] [keywod2]  ... ```
 - example ```php artisan product:scrape kopi susu```

### Api Version
- Please visit Api Documentation https://documenter.getpostman.com/view/7411255/TzsWtVcF

## ENV Example
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:/TR20t6EvnkDkLY9d7uN8+dCHFSb7dl3LoJL6ci5Y5U=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=shopee_scraper
DB_USERNAME=root
DB_PASSWORD=root


BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

JWT_SECRET=AEI8HoOzWv6WhGGGf7DmrDW8VTo1ZoPrAD9jqaaIv2eQVzurCCciz6tXaRh33ZBj

```
