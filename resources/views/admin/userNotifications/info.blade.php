@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                <a href="{{route('userNotifications.edit',$userNotification->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>آیدی کاربر : </span>
                    <span>{{$userNotification->user_id}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>آیدی نوتیفیکیشن : </span>
                    <span>{{$userNotification->notification_id}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>خوانده شده در : </span>
                    <span>{{$userNotification->seen_at}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا نوتیفیکیشن‌های کاربر مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'userNotifications/{{$userNotification->id}}',{
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