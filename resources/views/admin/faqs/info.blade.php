@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                <a href="{{route('faqs.edit',$faq->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>پرسش : </span>
                    <span>{{$faq->question}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>پاسخ : </span>
                    <span>{{$faq->answer}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا پرسش و پاسخ مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'faqs/{{$faq->id}}',{
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