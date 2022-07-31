@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                @if(auth()->user()->supper_admin)
                <a href="{{route('menus.edit',$menu->id)}}" class="btn btn-info btn-sm">ویرایش</a>
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
                @endif
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>عنوان : </span>
                    <span>{{$menu->title}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>شناسه : </span>
                    <span>{{$menu->key}}</span>
                </div>
                @include("admin.partials.subscribe-accessibility",["data"=>$menu,'notEdit'=>true,"notRefreshTime"=>true])
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا منو مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'menus/{{$menu->id}}',{
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