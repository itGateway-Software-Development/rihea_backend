<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request) {
        $name = $request->input('fullname');
        $nrc  = $request->input('nrc');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $hotelName = $request->input('hotelName');
        $noOfRoom = $request->input('noOfRoom');
        $noOfEmployee = $request->input('noOfEmployee');
        $hotelAddress = $request->input('hotelAddress');
        $zone = $request->input('zone');
        $fax = $request->input('fax');

        $mailData = [
            'name' => $name,
            'nrc' => $nrc,
            'address' => $address,
            'phone' => $phone,
            'hotelName' => $hotelName,
            'noOfRoom' => $noOfRoom,
            'noOfEmployee' => $noOfEmployee,
            'hotelAddress' => $hotelAddress,
            'zone' => $zone,
            'fax' => $fax
        ];

        Mail::to('hotelier.financedept@gmail.com')->send(new TestMail($mailData));


        return response()->json(['message' => 'form submit success']);
    }
}
