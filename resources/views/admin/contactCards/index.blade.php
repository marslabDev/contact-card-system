@extends('layouts.admin')
@section('content')
@can('contact_card_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.contact-cards.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.contactCard.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ContactCard', 'route' => 'admin.contact-cards.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contactCard.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ContactCard">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.company_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.company_position') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.company_website') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.handphone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.office_phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.facebook_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.instagram_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.whatsapp_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.wechat') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.youtube_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.tiktok') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.xiao_hong_shu') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.slogan') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.mission') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.vision') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.banner_image') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCard.fields.profile_image') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('contact_card_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contact-cards.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.contact-cards.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'first_name', name: 'first_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'company_name', name: 'company_name' },
{ data: 'company_position', name: 'company_position' },
{ data: 'company_website', name: 'company_website' },
{ data: 'email', name: 'email' },
{ data: 'handphone_number', name: 'handphone_number' },
{ data: 'office_phone_number', name: 'office_phone_number' },
{ data: 'facebook_url', name: 'facebook_url' },
{ data: 'instagram_url', name: 'instagram_url' },
{ data: 'whatsapp_number', name: 'whatsapp_number' },
{ data: 'wechat', name: 'wechat' },
{ data: 'youtube_url', name: 'youtube_url' },
{ data: 'tiktok', name: 'tiktok' },
{ data: 'xiao_hong_shu', name: 'xiao_hong_shu' },
{ data: 'slogan', name: 'slogan' },
{ data: 'mission', name: 'mission' },
{ data: 'vision', name: 'vision' },
{ data: 'banner_image', name: 'banner_image', sortable: false, searchable: false },
{ data: 'profile_image', name: 'profile_image', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ContactCard').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection