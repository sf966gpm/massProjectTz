<?php

namespace App\Services;

use App\Mail\ResolvedRequest;
use App\Models\RequestModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequestModelService
{
    public function updateRequestModel(array $validated, RequestModel $request)
    {
        $request->update([
            'comment' => $validated['comment'],
            'status' => 'Resolved'
        ]);
        return $request;
    }

    public function createRequestModel(array $validated)
    {
        $requestModel = RequestModel::create([
            'users_id' => Auth::user()->id,
            'message' => $validated['message'],
        ]);
        $requestModel->refresh();
        return $requestModel;
    }

    public function sendEmail(RequestModel $request)
    {
        Mail::to($request->user->email)->send(new ResolvedRequest($request->comment));
    }
}
