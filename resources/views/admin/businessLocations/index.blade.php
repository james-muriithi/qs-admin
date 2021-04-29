@extends('layouts.admin')
@section('content')
@can('business_location_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.business-locations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.businessLocation.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.businessLocation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BusinessLocation">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.businessLocation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessLocation.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessLocation.fields.bsid') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessLocation.fields.coordinates') }}
                        </th>
                        <th>
                            {{ trans('cruds.businessLocation.fields.qr') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($businessLocations as $key => $businessLocation)
                        <tr data-entry-id="{{ $businessLocation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $businessLocation->id ?? '' }}
                            </td>
                            <td>
                                {{ $businessLocation->name ?? '' }}
                            </td>
                            <td>
                                {{ $businessLocation->bsid->bsid ?? '' }}
                            </td>
                            <td>
                                {{ $businessLocation->coordinates ?? '' }}
                            </td>
                            <td>
                                @if($businessLocation->qr)
                                    <a href="{{ $businessLocation->qr->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $businessLocation->qr->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('business_location_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.business-locations.show', $businessLocation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('business_location_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.business-locations.edit', $businessLocation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('business_location_delete')
                                    <form action="{{ route('admin.business-locations.destroy', $businessLocation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('business_location_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.business-locations.massDestroy') }}",
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
  let table = $('.datatable-BusinessLocation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection