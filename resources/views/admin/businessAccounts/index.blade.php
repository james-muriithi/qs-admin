@extends('layouts.admin')
@section('content')
@can('business_account_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.business-accounts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.businessAccount.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.businessAccount.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BusinessAccount">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bsid') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_contact') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_industry') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.employees') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessAccount.fields.date_created') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($businessAccounts as $key => $businessAccount)
                        <tr data-entry-id="{{ $businessAccount->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $businessAccount->id ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->bsid ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->bs_name ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->bs_location ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->bs_contact ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->bs_email ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->bs_logo ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->bs_industry ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->employees ?? '' }}
                            </td>
                            <td>
                                {{ $businessAccount->date_created ?? '' }}
                            </td>
                            <td>
                                @can('business_account_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.business-accounts.show', $businessAccount->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('business_account_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.business-accounts.edit', $businessAccount->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('business_account_delete')
                                    <form action="{{ route('admin.business-accounts.destroy', $businessAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('business_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.business-accounts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-BusinessAccount:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection