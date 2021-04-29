<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessAccountRequest;
use App\Http\Requests\UpdateBusinessAccountRequest;
use App\Http\Resources\Admin\BusinessAccountResource;
use App\Models\BusinessAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessAccountApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessAccountResource(BusinessAccount::all());
    }

    public function store(StoreBusinessAccountRequest $request)
    {
        $businessAccount = BusinessAccount::create($request->all());

        return (new BusinessAccountResource($businessAccount))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BusinessAccount $businessAccount)
    {
        abort_if(Gate::denies('business_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessAccountResource($businessAccount);
    }

    public function update(UpdateBusinessAccountRequest $request, BusinessAccount $businessAccount)
    {
        $businessAccount->update($request->all());

        return (new BusinessAccountResource($businessAccount))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BusinessAccount $businessAccount)
    {
        abort_if(Gate::denies('business_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessAccount->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
