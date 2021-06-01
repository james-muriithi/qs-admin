<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessAccountRequest;
use App\Http\Requests\StoreBusinessAccountRequest;
use App\Http\Requests\UpdateBusinessAccountRequest;
use App\Mail\ConfirmAccount;
use App\Models\BusinessAccount;
use App\Models\OrgUser;
use App\Notifications\UserCreateNotification;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BusinessAccountController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessAccounts = BusinessAccount::all();

        $paginatedBusinessAccounts = BusinessAccount::paginate(20);

        return view('admin.businessAccounts.index1', compact('businessAccounts', 'paginatedBusinessAccounts'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessAccounts.create1');
    }

    public function store(StoreBusinessAccountRequest $request)
    {
        $request->merge(['Access_Code' => sha1($request->input('Access_Code'))]);

        $businessAccount = BusinessAccount::create($request->all());

        $orgUser = OrgUser::create([
            'username' => $businessAccount->BS_ID,
            'bs_id' => $businessAccount->BS_ID,
            'name' => $businessAccount->BS_Name,
            'verification_token' => Str::random(60),
            'email' => $businessAccount->BS_Email,
            'role_id' => 1,
            'approved' => 1,
            'is_admin' => 1,
        ]);

//        $orgUser->notify(new UserCreateNotification($orgUser));
        Mail::to($orgUser->email)->send(new ConfirmAccount($orgUser));

        return redirect()->route('admin.business-accounts.index')->with('success', 'Organisation created successfully');
    }

    public function edit(BusinessAccount $businessAccount)
    {
        abort_if(Gate::denies('business_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessAccounts.edit1', compact('businessAccount'));
    }

    public function update(UpdateBusinessAccountRequest $request, BusinessAccount $businessAccount)
    {
        $businessAccount->update($request->all());

        $folder = $path = env('APP_ENV') == 'local' ? Storage::disk('public')->path('uploads').'/' :
            '/home/oyaacoke/quickscan.brancetech.com/assets/img/logos/';

        if ($request->input('BS_Logo', false)) {
            if (!$businessAccount->BS_Logo || $request->input('BS_Logo') !== $businessAccount->BS_Logo) {
                if ($businessAccount->BS_Logo && file_exists($folder.$request->input('BS_Logo'))) {
                    unlink($folder.$request->input('BS_Logo'));
                }
            }
        }else{
            if ($businessAccount->BS_Logo && file_exists($businessAccount->logoFullPath)) {
                unlink($businessAccount->logoFullPath);
                $businessAccount->BS_Logo = '';
                $businessAccount->save();
            }
        }

        return redirect()->route('admin.business-accounts.index')->with('success', 'Organisation updated successfully');
    }

    public function show(BusinessAccount $businessAccount)
    {
        abort_if(Gate::denies('business_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessAccount->load('businessLocations');

        return view('admin.businessAccounts.show1', compact('businessAccount'));
    }

    public function destroy(BusinessAccount $businessAccount)
    {
        abort_if(Gate::denies('business_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessAccount->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessAccountRequest $request)
    {
        BusinessAccount::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function mostActive(Request $request)
    {
        if ($request->ajax()) {
            //request params
            $year = $request->input('year', date('Y'));
            $month = $request->input('month', date('m'));
            $bsId = $request->input('bs_id', '');

            $bsAccount = BusinessAccount::findOrFail($bsId);

            $query  = $bsAccount->load('employees')->employees;

//            $query->select(sprintf('%s.*', (new Employee())->table));

//            dd($query);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('emp_id', function ($row) {
                return $row->emp_id ? $row->emp_id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('contact', function ($row) {
                return $row->contact ? $row->contact : '';
            });

            $table->editColumn('genid', function ($row) {
                return $row->GenId ? $row->GenId : '';
            });

            $table->editColumn('check_ins', function ($row) use ($month, $year) {
                return $row->monthlyAttendedTimes($month, $year) ?? '';
            });

            $table->rawColumns(['name']);

            return $table->make(true);
        }
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
            '/home/u675959526/domains/quickscan.brancetech.com/assets/img/logos/';

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
