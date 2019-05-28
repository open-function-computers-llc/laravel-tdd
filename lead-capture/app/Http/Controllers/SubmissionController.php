<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::get();

        return view("submissions.index", [
            'submissions' => $submissions,
        ]);
    }
}
