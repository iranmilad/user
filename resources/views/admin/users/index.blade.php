@extends('admin.layouts.app')
@section('css')
  <link href="{{asset('assets/plugins/dataTables/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
  <div class="d-flex justify-content-between mb-3">
        <h5> فهرست ‌کاربران </h5>
        <a href="{{route('users.create')}}" class="btn btn-info btn-sm mb-3 float-start">افزودن کاربر جدید </a>

    </div>
    <table id="data-table" class="table table-striped" style="width:100%">
        <thead>
        <tr>
           <th>#</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>شماره موبایل</th>
            <th>اشتراک</th>
            <th>فعال</th>         
            <th>تاریخ ثبت</th>
            <th>عملیات</th>
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
            ajax: baseUrl+"users",
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
                {"data": "first_name"},
                {"data": "last_name"},
                {"data": "mobile"},
                {
                    data: 'special',
                    className: 'search_disabled',
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return row.special?"ویژه":"عادی";
                    }
                },
                {
                    data: 'active',
                    className: 'search_disabled',
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return `<input class="change-active" data-value="${row.id}" type="checkbox" ${row.active ? "checked" : ""}/>`;
                    }
                },
                 {data:'created_at'},
                 {
                    data:'',
                     className:'search_disabled',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return  '<a href="'+baseUrl+'users/'+row.id+'"><i class="bi bi-info-circle" title="نمایش" data-value="' + row.id + '" ></i></a>' +
                            '<a href="'+baseUrl+'users/'+row.id+'/edit"><i class="bi bi-pencil-square me-2 text-success" title="ویرایش" data-value="' + row.id + '" ></i></a>'
                        +'<a class="delete-btn me-2" href="javascript:void(0)" data-value="' + row.id + '" ><i class="bi bi-trash text-danger" title="حذف" ></i></a>';
                    }
                },
            ],
            "order": [[ 6,'desc']]}
            $(document).on('click','.delete-btn',function (){
                $(this).closest('tr').addClass('selected');
                const id=$(this).data('value');
                var r = confirm("آیا کاربر مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'users/'+id,{
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
            });

            $(document).on("click", ".change-active", function (e) {
                e.preventDefault()
                const hasCheck=e.target.checked
                const id = $(this).data('value');
                var r = confirm(!hasCheck?"آیا کاربر مورد نظر غیر فعال شود؟":"آیا کاربر مورد نظر فعال شود؟")
                if (r === true) {
                    $.ajax(baseUrl + 'user/' + id+"/change-active", {
                        method: 'put',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'accept': 'application/json',
                        },
                        success: function (res) {
                            if(hasCheck){
                                e.target.checked=true
                            }else{
                                e.target.checked=false
                            }
                        },
                        error: function (er) {
                            alert("خطا")
                        }
                    })
                }
            }
        )
    </script>
    <script src="{{asset('assets/plugins/dataTables/init.dataTable.js')}}"></script>
@endpush