<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadAdminEmailMd;
use App\Mail\NewLeadEmailMd;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{



    function store(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:50',
            'address' => 'required',
            'user_mail' => 'required|email',
            'phone' => 'required|regex:/^\+?[0-9]+$/',
            'notes' => 'nullable|max:200',
        ]);


        // redirect if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // altimenti keep going 👇


        // save the new lead in the db
        $lead = Lead::create($request->all());

        // send email to user
        Mail::to($lead->user_mail)->send(new NewLeadEmailMd($lead));
        // send email to deliveboo
        Mail::to("info@deliveboo.com")->send(new NewLeadAdminEmailMd($lead));

        // return a json success response


        return response()->json(
            [
                'success' => true,
                'message' => 'Form sent successfully!'
            ]
        );
    }
}
