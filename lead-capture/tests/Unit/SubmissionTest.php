<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Submission;

class SubmissionTest extends TestCase
{
    /** @test */
    public function weCanGetTheFullNameOffASubmission()
    {
        $s = new Submission;
        $s->first_name = "Kurtis";
        $s->last_name = "Holsapple";

        $this->assertEquals("Kurtis Holsapple", $s->fullName);
    }

    /** @test */
    public function canGetTheSubmissionNameInTheWeird8CharacterFormat()
    {
        $s = new Submission;
        $s->first_name = "Sammy";
        $s->last_name = "Jones";

        $this->assertEquals("SAMMJONE", $s->oldSystemFormat);
    }

}
