@extends('admin.layouts.app')
@section('css')
  <link href="{{asset('assets/plugins/dataTables/jquery.dataTables.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
            <div class="mb-4">
                <a href="{{route('memberLists.edit',$memberList->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn-member-list" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$memberList->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>توضیحات : </span>
                    <span>{{$memberList->description}}</span>
                </div>                

                @include("admin.partials.subscribe-accessibility",["data"=>$memberList,'notEdit'=>true,"notRefreshTime"=>true])

                <div class="d-flex mb-3 mt-5">
                    <h5> فهرست اعضا </h5>
                    <form method="POST" action="{{ route('memberList.users.create',$memberList->id) }}" class="me-4 col-5 d-flex">
                        @csrf
                        @include('admin.partials.select-user',["noLable"=>true,"required"=>true])
                        <button type="submit" class="btn btn-info btn-sm me-3 text-nowrap">افزودن کاربر</button>
                    </form>            
                </div>
                <table id="data-table" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                       <th>#</th>
                        <th>نام کاربر</th>                       
                        <th>زمان عضو شدن</th>
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
            ajax: baseUrl+"memberLists/{{ $memberList->id }}/users",
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
                    {
                        data: 'user',
                        searchable: "relation",
                        name: "first_name+last_name",
                        render: function (data, type, row, meta) {
                            return '<a target="_blank" href="' + baseUrl + 'users/' + row.user_id + '" >' + (row.user ? (row.user.first_name + " " + row.user.last_name) : '') + '</a>';
                        }
                    },
                    {data:'created_at'},
                    {
                    data:'',
                        className:'search_disabled',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return  '<a class="delete-btn me-2" href="javascript:void(0)" data-value="' + row.id + '" ><i class="bi bi-trash text-danger" title="حذف" ></i></a>';
                    }
                },
            ],
            "order": [[ 2,'desc']]}
            $(document).on('click','.delete-btn',function (){
                $(this).closest('tr').addClass('selected');
                const id=$(this).data('value');
                var r = confirm("آیا کاربر مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'memberLists/{{ $memberList->id }}/users/'+id,{
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

            $(document).on('click','.delete-btn-member-list',function (){
                var r = confirm("آیا ممبر لیست مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'memberLists/{{$memberList->id}}',{
                        method:'delete',
                        success:function (res){
                             window.history.back();
                        },
                        error:function (er){
                            alert("Error deleting")
                        }
                    })
                }
            })
    </script>
    <script src="{{asset('assets/plugins/dataTables/init.dataTable.js')}}"></script>
 
@endpush