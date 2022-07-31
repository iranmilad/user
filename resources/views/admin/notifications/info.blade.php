@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                <a href="{{route('notifications.edit',$notification->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$notification->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>متن : </span>
                    <span>{{$notification->text}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>نوع : </span>
                    <span>{{ App\Constants\NotificationTypes::aliases($notification->type)}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا نوتیفیکیشن مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'notifications/{{$notification->id}}',{
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