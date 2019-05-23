# Install Laravel

https://laravel.com/docs/5.8/installation

`composer create-project --prefer-dist laravel/laravel lead-capture`

# Check out base Laravel install

Let's check out what Laravel gives us right away, from the code to the built in dev server

- `cd lead-capture`
- `php artisan serve`
- look at .env
- homestead vs. non-homestead
- look at important files
    - routes/web.php
    - resources/views/welcome.blade.php
    - tests/Feature/ExampleTest.php
    - tests/Unit/ExampleTest.php

# Testing Vocabulary

So many things in the testing world have names, and with those names come opinions. At the end of the day, your test suite is yours! It is there to make sure the software you build does what it is supposed to, and eases that "I'm terrified to push code live Friday at 4:30" fear.

With that said, there are names for things to help you understand what type of tests there are, where they should live, and how you can use them.

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

# Configure PHPUnit to give us a coverage report

- Note, this is not 100% fool proof, but can give you a good idea of where you might want to write a few more tests
- PHPUnite configuration via XML file

# Sending Emails and testing methods

- Mocks vs. the real deal
- Look at mock code (https://stackoverflow.com/questions/25222570/laravel-unit-testing-emails)
- Look at Laravel Mailables (https://laravel.com/docs/master/mail) and Mail::fake()
- Generate a mailable `php artisan make:mail NewLeadNotification`
- Working with mail data, $mail->build()

# Acceptance tests

- MailCatcher
- Laravel Dusk
- `composer require --dev laravel/dusk`
- `php artisan dusk:install`
- Now we can write our first acceptance test, to make sure that we aren't just testing the built in Laravel Mail facade, but also that our system works when using it

# Testing Pyramid/Tech Debt
