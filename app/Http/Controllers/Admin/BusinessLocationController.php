<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessLocationRequest;
use App\Http\Requests\StoreBusinessLocationRequest;
use App\Http\Requests\UpdateBusinessLocationRequest;
use App\Models\BusinessAccount;
use App\Models\BusinessLocation;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BusinessLocationController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('business_location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessLocations = BusinessLocation::with(['business'])->get();

        $paginatedBusinessLocations = BusinessLocation::paginate(20);

        return view('admin.businessLocations.index1', compact('businessLocations', 'paginatedBusinessLocations'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('BS_Name', 'BS_ID')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.businessLocations.create1', compact('bsids'));
    }

    public function store(StoreBusinessLocationRequest $request)
    {
        if ($request->has('polygon')){
            $request->merge(['polygon' => implode(' ', $request->input('polygon')) ]);
        }
        $businessLocation = BusinessLocation::create($request->all());

        return redirect()->route('admin.business-locations.index')->with('success', 'Organisation location created successfully');
    }

    public function edit(BusinessLocation $businessLocation)
    {
        abort_if(Gate::denies('business_location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('BS_Name', 'BS_ID')->prepend(trans('global.pleaseSelect'), '');

        $businessLocation->load('business');

        return view('admin.businessLocations.edit1', compact('bsids', 'businessLocation'));
    }

    public function update(UpdateBusinessLocationRequest $request, BusinessLocation $businessLocation)
    {
        if ($request->has('polygon')){
            $request->merge(['polygon' => implode(' ', $request->input('polygon')) ]);
        }

        $businessLocation->update($request->all());

        if ($request->input('qr', false)) {
            if (!$businessLocation->qr || $request->input('qr') !== $businessLocation->qr) {
                if ($businessLocation->qr) {
                    unlink(public_path('storage/uploads/'.$businessLocation->qr));
                }
            }
        }else{
            if ($businessLocation->qr) {
                unlink(public_path('storage/uploads/'.$businessLocation->qr));
            }
        }

        return redirect()->route('admin.business-locations.index')->with('success', 'Organisation location updated successfully');
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

    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }
        // If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = env('APP_ENV') == 'local' ? Storage::disk('public')->path('uploads') :
            '/home/u675959526/public_html/quickscan/public/assets/img/logos/';

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
