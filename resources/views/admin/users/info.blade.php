@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                <a href="{{route('users.edit',$user->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>نام : </span>
                    <span>{{$user->first_name}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>نام خانوادگی : </span>
                    <span>{{$user->last_name}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>شماره موبایل : </span>
                    <span>{{$user->mobile}}</span>
                </div>
                {{-- <div class="mt-3">
                    <span class='fw-bold'>ایمیل : </span>
                    <span>{{$user->email}}</span>
                </div> --}}               
                <div class="mt-3">
                    <span class='fw-bold'>وضعیت : </span>
                    <span>{{$user->active?"فعال":"غیر فعال"}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا کاربر مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'users/{{$user->id}}',{
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