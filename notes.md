# Slides

https://docs.google.com/presentation/d/1McRUR3ID_6TnHOqeZdebn40O6dJgTLDFuj4g9hWwH8k/edit?usp=sharing

# Getting started

- https://laravel.com/docs/5.8/installation
- what are we building? look at the scope doc
- `composer create-project --prefer-dist laravel/laravel lead-capture`

# Check out base Laravel install

Let's check out what Laravel gives us right away, from the code to the built in dev server

- `cd lead-capture`
- `php artisan serve`
- non-homestead (vagrant virtual machine) for this tutorial
- look at important files
    - routes/web.php
    - resources/views/welcome.blade.php
    - tests/Feature/ExampleTest.php
    - tests/Unit/ExampleTest.php

# Testing Vocabulary

- So many things in the testing world have names, and with those names come opinions. At the end of the day, your test suite is yours! It is there to make sure the software you build does what it is supposed to, and eases that "I'm terrified to push code live Friday at 4:30" fear.
- With that said, there are names for things to help you understand what type of tests there are, where they should live, and how you can use them.
- AAA
  - Assemble
  - Act
  - Assert

# Working with PHPUnit

- Set up aliases, code snippets, and see what your IDE or editor can automate for you. Get the most out of your tools!
- `pt` (./vendor/bin/phpunit)
- `ptf` (./vendor/bin/phpunit --filter)
- Read your requirements, and get to work! If you don't have requirements from a designer/copy writer/both, write your own! These become your tests.
- Write your first test
- `php artisan make:test FormTest`

# With Exception Handling, Without Exception Handling

- `$this->withoutExceptionHandling();`
- Note how when validation errors are encountered, we need to follow the redirect to verify that the error messages are shown correctly
- Now that we can check validation, let's check that the success response is shown to the user
- Working with Laravel's Session and ->with()

# Sending Emails and testing methods

- Mocks vs. the real deal
- Look at mock code (https://stackoverflow.com/questions/25222570/laravel-unit-testing-emails)
- Look at Laravel Mailables (https://laravel.com/docs/master/mail, https://laravel.com/docs/master/mocking#mail-fake) and Mail::fake()
- Generate a mailable `php artisan make:mail NewLeadNotification`
- Working with mail data, $mail->build()
- https://laravel.com/docs/5.8/http-tests#available-assertions

# Acceptance tests

- MailCatcher
- Laravel Dusk
- `composer require --dev laravel/dusk`
- `php artisan dusk:install`
- Now we can write our first acceptance test, to make sure that we aren't just testing the built in Laravel Mail facade, but also that our system works when using it

# Testing Pyramid/Tech Debt
- Go back to the slide and realize how much we've completed without a single unit test
- This is the importance of working inside a framework. You can get a lot done in you know how to use it, because you're off loading much of how the system works (and each of the system's individual parts, or units) to the tests written by the framework and package authors.
- This is why some people consider large frameworks tech debt. This is true, but that's why understanding the framework is so important, so you can weigh the tech debt cost/value.
- Go back to the system requirements and see what requirements are left

# Begin to build submissions page
- Start with feature/integration test. If you came to Cascadia PHP last year, Jessica Mauerhan gave a great talk about the TDD & BDD double loop. This is the same idea we will use here, but all via PHPUnit.
- `php artisan make:test SubmissionListTest`
- `php artisan make:controller SubmissionController`
- Set up new page, and this is a perfect time for a green -> green refactor! Let's set up some new layout stuff using our tests to make sure that everything that used to work still works
- Now we need to create our first Unit to populate this page
- `php artisan make:model Submission -m`
- Talk about eloquent and the SQL abstraction that we get out of the box with Laravel. After we look at how to configure Laravel to talk to a db, talk about a memory only SQLite database for testing only
- Talk about refresh database trait
- Now that tests are creating/resetting the database on each run, this can mess with our testing database. Let's change just PHPUnit to talk to a different database. In memory vs. a different mysql connection
