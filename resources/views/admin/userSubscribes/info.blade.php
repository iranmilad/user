@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                {{-- <a href="{{route('userSubscribes.edit',$userSubscribe->id)}}" class="btn btn-info btn-sm">ویرایش</a> --}}
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>کاربر : </span>
                    <span>{{$userSubscribe->user->full_name}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$userSubscribe->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>مبلغ : </span>
                    <span>{{number_format($userSubscribe->price)}} تومان</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>شناسه پرداخت : </span>
                    <span>{{$userSubscribe->payment_gu_id}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>تاریخ پایان : </span>
                    <span>{{ jdate($userSubscribe->expire_at)->format(App\Constants\jDateFormat::S)}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا اشتراک کاربر مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'userSubscribes/{{$userSubscribe->id}}',{
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