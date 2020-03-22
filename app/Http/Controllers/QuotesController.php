<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Mail\CompanyQoute;
use Illuminate\Support\Facades\Mail;

class QuotesController extends Controller
{
    function sendEmail(SendEmailRequest $request)
    {

        $this->sendQuoteEmail($request->except('_method'));

        return response()->json(["data" => "done"]);


    }

    function sendQuoteEmail($requestData)
    {
        $data = [
            'message'   => 'From '.$requestData["start_date"].' to '.$requestData["end_date"],
            'subject'   => $requestData["company_name"],

        ];

        Mail::to($requestData["email"])->send(new CompanyQoute($data));
    }
}
