<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequestCollection;
use App\Http\Resources\RequestResource;
use App\Models\Request;
//use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        return RequestCollection::make(Request::paginate());
    }

    public function show(Request $request)
    {
        return RequestResource::make($request);
    }
}
