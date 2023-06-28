# acapedia-technical-assessment-laravel

-   Please do not take more than 3-4 hours on this challenge.
-   If you are unable to complete a portion it is OK. We're looking to see how you work with and around the challenges.
-   If there are items left outstanding / things you did not get to please note them in the Pull request
-   Use git locally to track all the changes
-   Your `main` branch should have the project without your changes
-   Your implementation should be in another branch
-   Push the code to a private repo in your github and give us access to it
-   When you're complete create a Pull Request, including all the relevant info and assign us as reviewers.

## Tasks:

### Comments of posts

**Requirements:**

-   the comment must belong to a user, belong to a post, and have a required text
-   add an endpoint to add a comment to a post
-   add an endpoint to list the comments of a post
-   add an endpoint to remove a comment of a post

### Improve the list of posts

**Requirements:**

-   add the ability to search post by title
-   add the ability to filter posts by category
-   add pagination
-   calculate the amount of comments per post

**Note:**

-   the list posts endpoint is `GET /api/post`

### Improve the show post

**Requirements:**

-   show the newest 5 comments of a post
-   calculate the amount of comments

**Note:**

-   the show post endpoint is `GET /api/post/:id`

### Add the update post (optional)

**Requirements:**

-   add the ability to update a post
-   only the category and the description can be updated

**Note:**

-   the update post endpoint should be `PUT /api/post/:id`

## Things we will be assessing

-   Clean code
-   Laravel best practices
-   Structuring your code to match the patterns of our code
-   Clean architecture
-   Tests, error handling, logging and validations
-   Pull request description and clarity
-   Improve some of the existing code

## Project setup

```bash
# spin up the containers for the web server
$ docker-compose up -d --build site

# install the dependencies
$ docker-compose run --rm composer install
$ docker-compose run -w /var/www/html/Business/Entities/Validations --rm composer install

# Generate the empty env file
$ cp src/.env.example src/.env

# Generate the laravel key
$ docker-compose run --rm artisan key:generate

# Run the laravel migrations when the db (you may have to wait for the db to be ready in order to run this command)
$ docker-compose run --rm artisan migrate --seed

# To discover some file classes run:
$ docker-compose run --rm composer dump-autoload
$ docker-compose run -w /var/www/html/Business/Entities/Validations --rm composer dump-autoload
```

At this point you should see the site up and running on port 8081, we have an status endpoint in [/api/health](http://localhost:8081/api/health)

## Troubleshooting

-   if you have issues with permissions run `sudo chown $USER. -R src/`
