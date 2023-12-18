<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestModelRequest;
use App\Http\Requests\UpdateRequestModelRequest;
use App\Http\Resources\RequestCollection;
use App\Http\Resources\RequestResource;
use App\Models\RequestModel;
use App\Services\RequestModelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class RequestController extends Controller
{
    public function index(RequestModelService $service): RequestCollection
    {
        $this->authorize('viewAny', Auth::user());
        return RequestCollection::make($service->requestModelWithFilters());
    }

    public function show(RequestModel $request): RequestResource
    {
        $this->authorize('viewAny', Auth::user());
        return RequestResource::make($request->load('user'));
    }

    public function update(RequestModel              $request,
                           UpdateRequestModelRequest $requestData,
                           RequestModelService       $service
    ): RequestResource
    {
        $user = Auth::user();

        $this->authorize('update', $user);
        $validated = $requestData->validated();
        $request = $service->updateRequestModel($validated, $request->load('user'));
        $service->sendEmail($request);
        return RequestResource::make($request);

    }

    public function store(StoreRequestModelRequest $requestData, RequestModelService $service): JsonResponse
    {
        $validated = $requestData->validated();
        $requestModel = $service->createRequestModel($validated);
        return RequestResource::make($requestModel)
            ->response()
            ->setStatusCode(201);

    }
}
