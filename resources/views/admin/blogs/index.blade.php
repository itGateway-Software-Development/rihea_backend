@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="custom-header">
        {{ trans('cruds.blog.title_singular') }} {{ trans('global.list') }}

        @can('blog_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.blogs.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.blog.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.blog.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.blog.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.blog.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.blog.fields.body') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $key => $blog)
                        <tr data-entry-id="{{ $blog->id }}">
                            <td>
                                {{ $blog->id ?? '' }}
                            </td>
                            <td>
                                {{ $blog->date ?? '' }}
                            </td>
                            <td>
                                {{ $blog->title ?? '' }}
                            </td>
                            <td class="text-center">
                                <img src="{{ asset('/storage/images/'.$blog->blogImages[0]->image) }}" width="100" height="60" alt="">
                            </td>
                            <td>
                                {!! $blog->body ? substr($blog->body, 0, 200).' ......' : '' !!}
                            </td>
                            <td>
                                @can('blog_show')
                                    <a class="p-0 glow"
                                        style="width: 26px;height: 36px;display: inline-block;line-height: 36px;color:grey;"
                                        href="{{ route('admin.blogs.show', $blog->id) }}">
                                        <i class='bx bx-show'></i>
                                    </a>
                                @endcan

                                @can('blog_edit')
                                    <a class="p-0 glow"
                                        style="width: 26px;height: 36px;display: inline-block;line-height: 36px;color:grey;"
                                        href="{{ route('admin.blogs.edit', $blog->id) }}">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                @endcan

                                @can('blog_delete')
                                    <form id="orderDelete-{{ $blog->id }}"
                                        action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden"
                                            style="width: 26px;height: 36px;display: inline-block;line-height: 36px;"
                                            class=" p-0 glow" value="{{ trans('global.delete') }}">
                                        <button
                                            style="width: 26px;height: 36px;display: inline-block;line-height: 36px;border:none;color:grey;background:none;"
                                            class=" p-0 glow"
                                            onclick="event.preventDefault(); document.getElementById('orderDelete-{{ $blog->id }}').submit();">
                                            <i class="bx bx-trash"></i>
                                        </button>
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
