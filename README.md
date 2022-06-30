### 1 Install necessary dependency
`composer install`

### 2
set your env variables
for the database

### run the migration
`php artisan:migrate`

### run the database seeder
`php artisan db:seed`

### Available routes
##### this route return a post record
`'/posts/{post}'`


##### this route create a new post
`'/posts/create'`

`site_id: integer, title: string, body: string, image: file`


##### this route subscribe a new user
`'/subscribe'`

`site_id: integer, email: string, name: string`