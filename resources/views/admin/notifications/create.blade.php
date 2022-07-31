@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('notifications.store')}}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="title" class="form-label"><span class="text-danger">*</span> عنوان</label>
                            <input type='text' class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')??''}}" required>
                            @error('title')
                                <span class="text-danger font-12">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mt-3">
                            <label for="text" class="form-label"><span class="text-danger">*</span> متن</label>
                            <textarea type='text' class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="5" required>{{old('text')??''}}</textarea>
                            @error('text')
                                <span class="text-danger font-12">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
               
                <div class="col-md-6 col-12 mt-5">   
                    <div class="col-12 mt-3">             
                        <input type='radio' id="type_public" name="type" @if(!old('type') || old('type')==1) checked @endif value="1">
                        <label for="type_public" class="form-label">ارسال برای همه کاربران</label> 
                    </div>
                    <div class="col-12 mt-3">             
                        <input type='radio' id="type_special" name="type" @if(old('type')==3) checked @endif value="3">
                        <label for="type_special" class="form-label">ارسال برای کاربران ویژه</label> 
                    </div>      
                    <div class="col-12 mt-3">             
                        <input type='radio' id="type_e" name="type" @if(old('type')==4) checked @endif value="4">
                        <label for="type_e" class="form-label">ارسال برای کاربران عادی</label> 
                    </div>   
                    <div class="col-12 mt-3">             
                        <input type='radio' id="member_list" name="type" @if(old('type')==5) checked @endif value="5">
                        <label for="member_list" class="form-label">ارسال برای ممبر لیست</label> 
                    </div>  
                    <div id="select-member-list-box" class="col-12 mt-3">     
                        <label for="member_list_id" class="form-label"><span class="text-danger">*</span> انتخاب ممبر لیست</label>       
                        <select class="form-select" id="member_list_id" name="member_list_id">
                            @foreach ( App\Models\MemberList::get(["id","title"]) as $memberList)
                                <option value="{{ $memberList->id }}">{{ $memberList->title }}</option>
                            @endforeach
                        </select>
                    </div>      
                    <div class="col-12 mt-3">             
                        <input type='radio' id="type_custom" name="type" @if(old('type')==2) checked @endif value="2">
                        <label for="type_custom" class="form-label">ارسال برای کاربران انتخابی</label> 
                    </div>                      
                    <div id="select-user-box" class="col-12 mt-3">             
                        @include("admin.partials.select-user")
                        @error('user_id')
                            <span class="text-danger font-12">{{ $message }}</span>
                        @enderror
                    </div>                      
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">ارسال نوتیفیکیشن</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">انصراف</button>
            </div>
        </form>
@endsection

@push('scripts')

    <script>
        $("#select-user-box").addClass('d-none');
        $("#select-member-list-box").addClass('d-none');
        $("input[name='type']").on("change",function(e){
            $("#select-user-box").addClass('d-none');
            $("#select-member-list-box").addClass('d-none');
            
            if(e.target.value==2){
                $("#select-user-box").removeClass('d-none');
            }else if(e.target.value==5){
                $("#select-member-list-box").removeClass('d-none');
            }
        });
    </script>
@endpush