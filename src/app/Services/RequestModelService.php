<?php

namespace App\Services;

use App\Mail\ResolvedRequest;
use App\Models\RequestModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;

class RequestModelService
{
    public function updateRequestModel(array $validated, RequestModel $request): RequestModel
    {
        $request->update([
            'comment' => $validated['comment'],
            'status' => 'Resolved'
        ]);
        return $request;
    }

    public function createRequestModel(array $validated): RequestModel
    {
        $requestModel = RequestModel::create([
            'users_id' => Auth::user()->id,
            'message' => $validated['message'],
        ]);
        $requestModel->refresh();
        return $requestModel;
    }

    /**
     * Отправляем письмо, пользователю
     * TODO: Должно быть поставлено в очередь, для асинхронного исполнения.
     * @param RequestModel $request
     * @return void
     */
    public function sendEmail(RequestModel $request): void
    {
        $request = $request->with('user')->first();
        $resolvedRequest = new ResolvedRequest($request);
        Mail::to($request->user->email)->send($resolvedRequest);
    }

    public function requestModelWithFilters(): LengthAwarePaginator
    {
        return QueryBuilder::for(RequestModel::class)
            ->with('user')
            ->allowedFilters('status')
            ->allowedSorts('created_at')
            ->paginate();
    }
}
