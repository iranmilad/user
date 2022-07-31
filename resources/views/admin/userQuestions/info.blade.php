@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                <a href="{{route('userQuestions.edit',$userQuestion->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>آیدی کاربر : </span>
                    <span>{{$userQuestion->user_id}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>نوع : </span>
                    <span>{{$userQuestion->type}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$userQuestion->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پرسش : </span>
                    <span>{{$userQuestion->question}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پاسخ : </span>
                    <span>{{$userQuestion->answer}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پاسخ داده شده در : </span>
                    <span>{{$userQuestion->answerd_at}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پاسخ داده توسط : </span>
                    <span>{{$userQuestion->answerd_by}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا پرسش‌های کاربر مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'userQuestions/{{$userQuestion->id}}',{
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