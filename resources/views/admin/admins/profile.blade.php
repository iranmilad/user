@extends('admin.layouts.app')

@section('content')
    <form action="{{route('admin.updateProfile')}}" method="post">
        @csrf
        @method("put")
        <div class="row mx-3">
            <div class="col-md-6 col-12  mt-3">
                    <label for="first_name" class="form-label"><span class="text-danger">*</span> نام</label>
                    <input class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                           value="{{@old('first_name')??$admin->first_name??''}}" required>
                @error('first_name')
                <span class="text-danger font-12">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 col-12  mt-3">
                    <label for="last_name" class="form-label"><span class="text-danger">*</span> نام خانوادگی</label>
                    <input class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                           value="{{@old('last_name')??$admin->last_name??''}}" required>
                @error('last_name')
                <span class="text-danger font-12">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 col-12  mt-3">
                    <label for="mobile" class="form-label">شماره موبایل</label>
                    <input class="form-control" id="mobile" name="mobile" value="{{$admin->mobile??''}}"
                           disabled>
            </div>
            {{-- <div class="col-md-6 col-12  mt-3">
                    <label for="username">نام کاربری</label>
                    <input class="form-control" id="username" name="username"
                           value="{{$admin->username??''}}" disabled>
                @error('username')
                <span class="text-danger font-12">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 col-12  mt-3">
                    <label for="email" class="form-label"><span class="text-danger">*</span> ایمیل</label>
                    <input class="form-control  @error('email') is-invalid @enderror" id="email" name="email"
                           value="{{@old('email')??$admin->email??''}}" required>
                @error('email')
                <span class="text-danger font-12">{{ $message }}</span>
                @enderror
            </div> --}}
            {{-- <div class="col-md-6 col-sm-12 mt-3">
                <input type="file" id="profile_image" class="d-none"  data-cropper="true"  data-ratio1="1" data-ratio2="1" >

                <label for="profile_image" class="btn btn-secondary image-button mt-2"> انتخاب
                    تصویر </label>

                <img width="100" alt="" src="{{asset("storage/images/admin/".$admin->profile_image)}}"
                                        class="image-preview">
            </div> --}}
        </div>
        <button type="submit" class="btn btn-primary btn-submit float-left mt-4">اعمال تغییرات</button>
    </form>
@endsection

@push('scripts')


@endpush
