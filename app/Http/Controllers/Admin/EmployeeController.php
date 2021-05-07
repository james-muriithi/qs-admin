<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\BusinessAccount;
use App\Models\Employee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::with(['organisation'])->get();
        $paginatedEmployees = Employee::query()
            ->with(['organisation'])
            ->paginate(20);

        return view('admin.employees.index1', compact('employees', 'paginatedEmployees'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('BS_Name', 'BS_ID')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employees.create1', compact('bsids'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $request->merge(['GenId' => $this->generateNextId($request->BS_ID)]);

        Employee::create($request->all());

        return redirect()->route('admin.employees.index');
    }

    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bsids = BusinessAccount::all()->pluck('BS_Name', 'BS_ID')->prepend(trans('global.pleaseSelect'), '');

        $employee->load('organisation');

        return view('admin.employees.edit1', compact('bsids', 'employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect()->route('admin.employees.index');
    }

    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->load('organisation');

        return view('admin.employees.show1', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRequest $request)
    {
        Employee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function generateNextId($bsId)
    {
        $generatedIds = Employee::query()
            ->where('BS_ID', $bsId)
            ->whereNotNull('GenId')
            ->where('GenId', '<>', '')
            ->orderBy('timestamp', 'DESC')
            ->get()
            ->pluck('GenId');

        $firstChar = substr($bsId, 0, 1);
        $intGenIds = [];

        foreach ($generatedIds as $genId){
            $id = (int) array_filter(explode($firstChar, $genId))[1];
            if (is_numeric($id)){
                array_push($intGenIds, $id);
            }
        }
        sort($intGenIds);
        $arr2 = range(1,max($intGenIds));

        $missing = array_values(array_diff($arr2, $intGenIds));

        $idWithZeros = count($missing) > 0 ? sprintf('%03d', $missing[0]) : sprintf('%03d', (end($intGenIds) + 1));

        return $firstChar.$idWithZeros;
    }
}
