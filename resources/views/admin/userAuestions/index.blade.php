@extends('admin.layouts.app')
@section('css')
  <link href="{{asset('assets/plugins/dataTables/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
  <div class="d-flex justify-content-between mb-3">
        <h5> پرسش‌های کاربر </h5>
        <a href="{{route('userAuestions.create')}}" class="btn btn-info btn-sm mb-3 float-start">create new پرسش‌های کاربر </a>

    </div>
    <table id="data-table" class="table table-striped" style="width:100%">
        <thead>
        <tr>
           <th>#</th>
            <th>آیدی کاربر</th>
            <th>نوع</th>
            <th>عنوان</th>
            <th>پرسش</th>
            <th>پاسخ داده شده در</th>
            <th>پاسخ داده توسط</th>
            <th>created at</th>
            <th>actions</th>
        </tr>
        </thead>
    </table>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('assets/plugins/dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/dataTables/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        const data_table_config={
            ajax: baseUrl+"userAuestions",
            columns: [
                 {
                    data:'',
                     className:'search_disabled',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.settings._iDisplayStart + meta.row + 1
                    }
                 },
                {"data": "user_id"},
                {"data": "type"},
                {"data": "title"},
                {"data": "question"},
                {"data": "answerd_at"},
                {"data": "answerd_by"},
                 {data:'created_at'},
                 {
                    data:'',
                     className:'search_disabled',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return  '<a href="'+baseUrl+'userAuestions/'+row.id+'"><i class="bi bi-info-circle" title="info" data-value="' + row.id + '" ></i></a>' +
                            '<a href="'+baseUrl+'userAuestions/'+row.id+'/edit"><i class="bi bi-pencil-square me-2" title="edit" data-value="' + row.id + '" ></i></a>'
                        +'<a class="delete-btn me-2" href="javascript:void(0)" data-value="' + row.id + '" ><i class="bi bi-trash" title="delete" ></i></a>';
                    }
                },
            ],
            "order": [[ 7,'desc']]}
            $(document).on('click','.delete-btn',function (){
                $(this).closest('tr').addClass('selected');
                const id=$(this).data('value');
                var r = confirm("Do you want to delete?")
                if (r === true) {
                    $.ajax(baseUrl+'userAuestions/'+id,{
                        method:'delete',
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                             'accept': 'application/json',
                        },
                        success:function (res){
                            table.row('.selected').remove().draw(false);
                        },
                        error:function (er){
                            alert("Error deleting")
                        }
                    })
                }else{
                    $(this).closest('tr').removeClass('selected');
                }
            })
    </script>
    <script src="{{asset('assets/plugins/dataTables/init.dataTable.js')}}"></script>
@endpush