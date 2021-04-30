<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessLocationRequest;
use App\Http\Requests\StoreBusinessLocationRequest;
use App\Http\Requests\UpdateBusinessLocationRequest;
use App\Models\BusinessAccount;
use App\Models\BusinessLocation;
use Gate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BusinessLocationController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessLocations = BusinessLocation::with(['business'])->get();

        return view('admin.businessLocations.index', compact('businessLocations'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('BS_Name', 'BS_ID')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.businessLocations.create', compact('bsids'));
    }

    public function store(StoreBusinessLocationRequest $request)
    {
        $businessLocation = BusinessLocation::create($request->all());

        return redirect()->route('admin.business-locations.index');
    }

    public function edit(BusinessLocation $businessLocation)
    {
        abort_if(Gate::denies('business_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('BS_Name', 'BS_ID')->prepend(trans('global.pleaseSelect'), '');

        $businessLocation->load('bsid');

        return view('admin.businessLocations.edit', compact('bsids', 'businessLocation'));
    }

    public function update(UpdateBusinessLocationRequest $request, BusinessLocation $businessLocation)
    {
        $businessLocation->update($request->all());

        return redirect()->route('admin.business-locations.index');
    }

    public function show(BusinessLocation $businessLocation)
    {
        abort_if(Gate::denies('business_location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessLocation->load('bsid');

        return view('admin.businessLocations.show', compact('businessLocation'));
    }

    public function destroy(BusinessLocation $businessLocation)
    {
        abort_if(Gate::denies('business_location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessLocation->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessLocationRequest $request)
    {
        BusinessLocation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
