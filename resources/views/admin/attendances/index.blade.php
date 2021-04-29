@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.attendance.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Attendance">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.bsid') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.employeeid') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.time_in') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.time_out') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.area_info') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.hours_in') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendance.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $key => $attendance)
                        <tr data-entry-id="{{ $attendance->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $attendance->id ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->bsid->bsid ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->bsid->bs_name ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->employeeid->employeeid ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->employeeid->name ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->date ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->time_in ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->time_out ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->location ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->area_info ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->hours_in ?? '' }}
                            </td>
                            <td>
                                {{ $attendance->status ?? '' }}
                            </td>
                            <td>
                                @can('attendance_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.attendances.show', $attendance->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan



                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Attendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection