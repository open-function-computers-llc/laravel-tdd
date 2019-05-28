<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewLeadNotification;
use Mail;

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
