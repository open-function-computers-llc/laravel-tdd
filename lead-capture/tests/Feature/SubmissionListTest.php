<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Submission;

class SubmissionListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyoneCanSeeAllSubmissionsViaTheSubmissionsLandingPage()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/submissions');

        $response->assertStatus(200);
    }

    /** @test */
    public function weCanSeeAllTheSubmissionsOnTheLandingPage()
    {
        $this->withoutExceptionHandling();
        for ($i=0; $i < 1000; $i++) {
            Submission::create([
                'first_name' => 'kurtis',
                'last_name' => 'holsapple',
                'email_address' => 'test@test.com',
            ]);
        }

        $response = $this->get("/submissions");
        $response->assertSee("Submissions");
        $response->assertSee("kurtis");
        $response->assertSee("holsapple");
        $response->assertSee("test@test.com");
    }
}
