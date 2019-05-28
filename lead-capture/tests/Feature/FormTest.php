<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLeadNotification;

class FormTest extends TestCase
{
    /** @test */
    public function theFormPageShowsTheCorrectCtaText()
    {
        $response = $this->get('/');

        $response->assertSee("Please give us your information");
    }

    /** @test */
    public function theFormHasTheCorrectInputFields()
    {
        $response = $this->get("/");
        $response->assertSee("First Name");
        $response->assertSee("Last Name");
        $response->assertSee("Primary Email Address");
        $response->assertSee("Phone Number");
    }

    /**
     * @test
     * @expectedException Illuminate\Validation\ValidationException
     * */
    public function allFieldsExceptPhoneNumberAreRequiredForSubmission()
    {
        $this->withoutExceptionHandling();
        $response = $this->post("/process");
    }

    /** @test */
    public function theCorrectValidationErrorMessagesAreShown()
    {
        $this->followingRedirects();
        $response = $this->post("/process", []);

        $response->assertSee("The first name field is required.");
        $response->assertSee("The last name field is required.");
        $response->assertSee("The email address field is required.");
    }

    /** @test */
    public function whenAUserSubmitsTheFormCorrectlyTheyAreShownTheCorrectMessage()
    {
        $this->followingRedirects();
        $response = $this->post("process", [
            "firstName" => "test",
            "lastName" => "test",
            "emailAddress" => "test",
        ]);

        $response->assertSee("Thank you so much! Someone will reach out to you soon.");
    }

    /** @test */
    public function whenAUserFillsOutTheFormTheFormSubmissionNotificationEmailIsSent()
    {
        $this->withoutExceptionHandling();
        Mail::fake();
        Mail::assertNothingSent();

        // send the from submission
        $info = [
            "firstName" => "test",
            "lastName" => "test",
            "emailAddress" => "test",
        ];
        $this->post("process", $info);

        Mail::assertSent(NewLeadNotification::class, function ($mail) use ($info) {
            $mail->build($info);

            return $mail->hasTo("staff@company.com") &&
                $mail->data['firstName'] === $info['firstName'] &&
                $mail->data['lastName'] === $info['lastName'] &&
                $mail->data['emailAddress'] === $info['emailAddress'];
        });
    }
}
