@extends('admin.layouts.app')
@section('css')
  <link href="{{asset('assets/plugins/dataTables/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
  <div class="d-flex justify-content-between mb-3">
        <h5> فهرست پرسش‌های ‌کاربران </h5>
        {{-- <a href="{{route('userQuestions.create')}}" class="btn btn-info btn-sm mb-3 float-start">افزودن پرسش‌های کاربر جدید </a> --}}

    </div>
    <table id="data-table" class="table table-striped" style="width:100%">
        <thead>
        <tr>
           <th>#</th>
            <th>کاربر</th>
            <th>نوع</th>
            <th>عنوان</th>
            <th>پرسش</th>
            <th>پاسخ</th>
            <th>پاسخ داده شده در</th>
            <th>پاسخ دهنده</th>
            <th>تاریخ ثبت</th>
            <th>عملیات</th>
        </tr>
        </thead>
    </table>
@endsection

@push("modals")
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">ارسال پاسخ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form method="post" action="{{route("userQuestions.answer")}}">
                            @csrf
                            <input type="hidden" name="id">
                            <div>
                                <label for="answer">پاسخ </label>
                                <textarea class="form-control mt-2" name="answer" id="answer"></textarea>
                            </div>
                            <div class="mt-4 d-flex justify-content-end">
                                <button class="btn btn-info btn-sm">ثبت پاسخ</button>
                                <button type="button" class="btn btn-secondary btn-sm  me-2" data-bs-dismiss="modal">
                                    انصراف
                                </button>
                            </div>
                        </form>         
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('assets/plugins/dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/dataTables/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        const data_table_config={
            ajax: baseUrl+"userQuestions",
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
                {"data": "type"},
                {"data": "title"},
                {"data": "question"},
                {"data": "answer"},
                {"data": "answerd_at"},
                {
                    data: 'responder',
                    searchable: "relation",
                    name: "first_name+last_name",
                    render: function (data, type, row, meta) {
                        return '<a target="_blank" href="' + baseUrl + 'admins/' + row.answerd_by + '" >' + (row.responder ? (row.responder.first_name + " " + row.responder.last_name) : '') + '</a>';
                    }
                },
                 {data:'created_at'},
                 {
                    data:'',
                     className:'search_disabled',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return  '<a href="'+baseUrl+'userQuestions/'+row.id+'"><i class="bi bi-info-circle" title="نمایش" data-value="' + row.id + '" ></i></a>' 
                            // '<a href="'+baseUrl+'userQuestions/'+row.id+'/edit"><i class="bi bi-pencil-square me-2 text-success" title="ویرایش" data-value="' + row.id + '" ></i></a>'
                        +'<a class="delete-btn me-2" href="javascript:void(0)" data-value="' + row.id + '" ><i class="bi bi-trash text-danger" title="حذف" ></i></a>'
                        +(row.answerd_at ? '':'<button class="btn btn-info px-2 py-0 font-sm me-2  answer-btn" data-value="'+row.id+'" data-bs-toggle="modal" data-bs-target="#confirmModal">پاسخ</button>');
                    }
                },
            ],
            "order": [[ 8,'desc']]}
            $(document).on('click','.delete-btn',function (){
                $(this).closest('tr').addClass('selected');
                const id=$(this).data('value');
                var r = confirm("آیا پرسش‌های کاربر مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'userQuestions/'+id,{
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
            $(document).on('click', '.answer-btn', function () {
            $('input[name="id"]').val($(this).data('value'))
        })
    </script>
    <script src="{{asset('assets/plugins/dataTables/init.dataTable.js')}}"></script>
@endpush