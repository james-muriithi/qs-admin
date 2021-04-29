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
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BusinessLocationController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('business_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessLocations = BusinessLocation::with(['bsid', 'media'])->get();

        return view('admin.businessLocations.index', compact('businessLocations'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('bsid', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.businessLocations.create', compact('bsids'));
    }

    public function store(StoreBusinessLocationRequest $request)
    {
        $businessLocation = BusinessLocation::create($request->all());

        if ($request->input('qr', false)) {
            $businessLocation->addMedia(storage_path('tmp/uploads/' . basename($request->input('qr'))))->toMediaCollection('qr');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessLocation->id]);
        }

        return redirect()->route('admin.business-locations.index');
    }

    public function edit(BusinessLocation $businessLocation)
    {
        abort_if(Gate::denies('business_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('bsid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $businessLocation->load('bsid');

        return view('admin.businessLocations.edit', compact('bsids', 'businessLocation'));
    }

    public function update(UpdateBusinessLocationRequest $request, BusinessLocation $businessLocation)
    {
        $businessLocation->update($request->all());

        if ($request->input('qr', false)) {
            if (!$businessLocation->qr || $request->input('qr') !== $businessLocation->qr->file_name) {
                if ($businessLocation->qr) {
                    $businessLocation->qr->delete();
                }
                $businessLocation->addMedia(storage_path('tmp/uploads/' . basename($request->input('qr'))))->toMediaCollection('qr');
            }
        } elseif ($businessLocation->qr) {
            $businessLocation->qr->delete();
        }

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_location_create') && Gate::denies('business_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessLocation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
