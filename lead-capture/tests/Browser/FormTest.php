<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormTest extends DuskTestCase
{
    private function turnOnMailCatcher()
    {
        system(env("MAILCATCHER_PATH"));
    }

    private function turnOffMailCatcher()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:1080')->
                clickLink("Quit")->
                acceptDialog();
        });
    }

    /** @test */
    public function canFillOutFormWhenSMTPIsWorking()
    {
        $this->turnOnMailCatcher();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Please give us your information');

            $browser->type("firstName", "Kurtis")
                ->type("lastName", "Holsapple")
                ->type("emailAddress", "kurtis@example.com")
                ->press("Sign Up");

            $browser->visit("http://localhost:1080")
                ->assertSee("New Lead Notification");
        });

        $this->turnOffMailCatcher();
    }

    /** @test */
    public function canSeeErrorMessageWhenSMTPIsNotWorking()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Please give us your information');

            $browser->type("firstName", "Kurtis")
                ->type("lastName", "Holsapple")
                ->type("emailAddress", "kurtis@example.com")
                ->press("Sign Up")
                ->assertSee('There was an error processing your request. Please try again later.');
        });
    }
}
