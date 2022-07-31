@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                <a href="{{route('userAuestions.edit',$userAuestion->id)}}" class="btn btn-info btn-sm">edit</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">delete</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>آیدی کاربر : </span>
                    <span>{{$userAuestion->user_id}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>نوع : </span>
                    <span>{{$userAuestion->type}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$userAuestion->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پرسش : </span>
                    <span>{{$userAuestion->question}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پاسخ داده شده در : </span>
                    <span>{{$userAuestion->answerd_at}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پاسخ داده توسط : </span>
                    <span>{{$userAuestion->answerd_by}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("Do you want to delete?")
                if (r === true) {
                    $.ajax(baseUrl+'userAuestions/{{$userAuestion->id}}',{
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
@endpush