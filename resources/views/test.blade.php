@extends('layouts.app')
@section('css')
    <link href="{{asset('assets/plugins/dataTables/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')

        <button class="btn btn-info btn-sm mb-3 float-start">افزودن </button>
    <table id="data-table" class="display" style="width:100%">
        <thead>
        <tr>
            <th>عملیات</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
        </tr>
        </tfoot>
    </table>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('assets/plugins/dataTables/jquery.dataTables.min.js')}}"></script>
    <script>
        const data_table_config={
            ajax: "cities",
            columns: [
                {
                    className:'search_disabled',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return  '<a href="city/'+row.id+'"><i class="bi bi-info-circle" title="جزئیات" data-value="' + row.id + '" ></i></a>' +
                            '<a href="city/update/'+row.id+'"><i class="bi bi-pencil-square me-2" title="ویرایش" data-value="' + row.id + '" ></i></a>'
                            +'<a class="delete-btn me-2" href="javascript:void(0)" data-value="' + row.id + '" ><i class="bi bi-trash" title="حذف" ></i></a>';
                    }
                },
            ]}
        $(document).on('click','.delete-btn',function (){
            $(this).closest('tr').addClass('selected');
            const id=$(this).data('value');
            var r = confirm("آیا رکورد مورد نظر حذف شود؟")
            if (r === true) {
                $.ajax('city/delete/'+id,{
                    method:'delete',
                    onsuccess:function (res){
                        var table = $('#data-table').DataTable();
                        table.row('.selected').remove().draw(false);
                    },
                    onerror:function (er){
                        alert("خطا در حذف رکورد مورد نظر")
                    }
                })
            }else{
                $(this).closest('tr').removeClass('selected');
            }
        })
    </script>
    <script src="{{asset('assets/plugins/dataTables/init.dataTable.js')}}"></script>
@endpush
