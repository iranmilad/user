@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                @if(auth()->user()->supper_admin)
                    <a href="{{route('charts.edit',$chart->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                    <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
                @endif
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$chart->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>شناسه : </span>
                    <span>{{$chart->key}}</span>
                </div>               
                <div class="mt-3">
                    <span class='fw-bold'>رفرش تایم : </span>
                    <span>{{$chart->refresh_time}} دقیقه</span>
                </div>              
                <div class="mt-3">
                    <span class='fw-bold'>feeder url : </span>
                    <span>{{$chart->feeder_url}}</span>
                </div>

                @include("admin.partials.subscribe-accessibility",["data"=>$chart,'notEdit'=>true])
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا نمودارها و جدول مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'charts/{{$chart->id}}',{
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