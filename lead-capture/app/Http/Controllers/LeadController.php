<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewLeadNotification;
use Mail;
use App\Submission;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'emailAddress' => 'required',
        ]);

        try {
            $submission = new Submission;
            // quite verbose, probably a different (*cough cough*, better) way to do this...
            $submission->first_name = $request->get('firstName');
            $submission->last_name = $request->get('lastName');
            $submission->email_address = $request->get('emailAddress');
            $submission->phone_number = $request->get('phoneNumber');
            $submission->save();

            // this mail action would be a great thing to add to a Model event listener...
            Mail::to("staff@company.com")->send(new NewLeadNotification([
                'firstName' => $request->get('firstName'),
                'lastName' => $request->get('lastName'),
                'emailAddress' => $request->get('emailAddress'),
                'phoneNumber' => $request->get('phoneNumber'),
            ]));
        } catch (\Exception $e) {
            return redirect("/")->with("error", "There was an error processing your request. Please try again later.");
        }

        return redirect("/")->with("success", "Thank you so much! Someone will reach out to you soon.");
    }
}
