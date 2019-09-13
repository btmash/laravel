# laravel

After cloning, run the following:

1. `docker-compose up -d`
1. `docker-compose exec php php /var/www/artisan migrate
1. Create the users in laravel using `docker-compose exec php php /var/www/artisan db:seed` (only available in the `completed-version branch) or via the mysql container.
1. View what is happening in the db via `docker-compose exec mysql mysql -u root -psecret homestead`

Then you could use postman or curl to make your requests based off the usernames (all of them have a password of 'password'). The site should be accessible via http://localhost:8080 (or you could change the docker container for the port). In the master branch, I did not get all the routes working (only `create`). However, the `completed-version` branch contains the seeder above plus all the other routes working (I created a PR so you can see a diff between the two versions). While I tried to use the resource approach, I was having trouble with PUT/PATCH and so had to resort to having an endpoint at `notes/{id}/update`. If I had even more time, I would fix the nginx issue.

The routes are otherwise accessible at (assuming you use basic auth with the right username/password):

`GET http://localhost:8080/api/notes` - Your notes
`GET http://localhost:8080/api/notes/{id}` - Your individual note
`POST http://localhost:8080/api/notes` - Create new note
`POST http://localhost:8080/api/notes/{id}/update` - Update existing note
`DELETE http://localhost:8080/api/notes/{id}` - Delete existing note
