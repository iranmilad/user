@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                <a href="{{route('subscribes.edit',$subscribe->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$subscribe->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>مبلغ : </span>
                    <span>{{number_format($subscribe->price)}} تومان</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>دوره (روز) : </span>
                    <span>{{$subscribe->period}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>توضیحات : </span>
                    <span>{{$subscribe->description}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا اشتراک مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'subscribes/{{$subscribe->id}}',{
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