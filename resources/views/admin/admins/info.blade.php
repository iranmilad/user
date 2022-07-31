@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">{!! auth()->user()->supper_admin?' <a href="'.route('admins.edit',$admin->id).'" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>':''
             !!}
               
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>نام : </span>
                    <span>{{$admin->first_name}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>نام خانوادگی : </span>
                    <span>{{$admin->last_name}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>شماره موبایل : </span>
                    <span>{{$admin->mobile}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>سوپر ادمین : </span>
                    <span>{{$admin->supper_admin?'بله':'خیر'}}</span>
                </div>              
                <div class="mt-3">
                    <span class='fw-bold'>فعال : </span>
                    <span>{{$admin->active?"فعال":"غیرفعال"}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا ادمین مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'admins/{{$admin->id}}',{
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