<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\BusinessAccount;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('BS_Name', 'BS_ID')->prepend('All', 'all');

        if ($request->ajax()) {
            $query = Attendance::query()
                ->with(['bsid', 'employee'])
                ->select(sprintf('%s.*', (new Attendance())->table));

            $bsid = $request->input('bs_id', null);
            $range = $request->input('range', null);
            //organisation
            if (!$bsid || $bsid == 'all'){
                $query->take(50);
            }
            else if ($bsid && BusinessAccount::where('BS_ID',$bsid)->count() > 0){
                $query->where('BS_ID', $bsid);
            }

            //date range
            if ($range){
                $start = explode(' to ', $range)[0] ?? $range;
                $to = explode(' to ', $range)[1] ?? '';

                if (!empty($start) && !empty($to)){
                    $start = Carbon::parse($start)->format('Y-m-d');
                    $to = Carbon::parse($to)->format('Y-m-d');

                    $query->whereBetween('date', [$start, $to]);
                } elseif (!empty($start) && empty($to)){
                    $query->where('date', $start);
                }
            }


            $table = Datatables::of($query->get());

            $table->addColumn('bsid_bsid', function ($row) {
                return $row->bsid ? $row->bsid->BS_ID : '';
            });

            $table->editColumn('bsid.bs_name', function ($row) {
                if ($row->bsid){
                    return sprintf('<a href="%s">%s</a>',route('admin.business-accounts.show', $row->bsid->id),
                        is_string($row->bsid) ? $row->bsid : $row->bsid->BS_Name );
                }
                return '';
            });
            $table->addColumn('employeeid_employeeid', function ($row) {
                return $row->employee_id ?? '';
            });

            $table->editColumn('employeeid.name', function ($row) {
                if ($row->employee){
                    return sprintf('<a href="%s">%s</a>',route('admin.employees.show', $row->id),
                        is_string($row->employee) ? $row->employee : $row->employee->name );
                }
                return '';
            });

            $table->editColumn('time_in', function ($row) {
                return $row->time_in ? $row->time_in : '';
            });
            $table->editColumn('time_out', function ($row) {
                return $row->time_out ? $row->time_out : '';
            });
            $table->editColumn('location', function ($row) {
                $url = 'https://www.google.com/maps?q='.$row->location;
                return sprintf('<a rel="noopener noreferrer" target="_blank" href="%s" title="%s">
                            %s
                        </a>', $url, $row->area_info ?? '' , $row->location ?? '' );
            });
            $table->editColumn('hours_in', function ($row) {
                return $row->hours_in ? $row->hours_in : '';
            });
            $table->editColumn('status', function ($row) {
                return sprintf('<span class="label label-sm label-rouded %s">%s</span>',
                    $row->status == 1 ? 'label-success px-3': 'label-warning px-4 mr-0',
                    $row->status == 1 ? 'Checked Out': 'Pending');
                return $row->status ? $row->status : '';
            });

            $table->addIndexColumn();
            $table->rawColumns(['bsid.bs_name', 'employeeid.name', 'location', 'status']);

            return $table->make(true);
        }

        return view('admin.attendances.index1', compact('bsids'));
    }

    public function show(Attendance $attendance)
    {
        abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance->load('bsid', 'employee');

        return view('admin.attendances.show', compact('attendance'));
    }
}
