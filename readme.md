Install laravel project

-> Run composer install

-> Set database credentials in database

-> Run migrations

Set keys in your .env file

```
BRAINTREE_ENV=sandbox
BRAINTREE_MERCHANT_ID=xxxx
BRAINTREE_PUBLIC_KEY=xxxx
BRAINTREE_PRIVATE_KEY=xxxx
 ```


-> Run the cron job in your on server 

if you want to see all the users with past payments you have to set `is_admin`
field in your `users` table.
