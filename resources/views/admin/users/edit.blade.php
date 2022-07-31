@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('users.update',$user->id)}}">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="first_name" class="form-label"><span class="text-danger">*</span>نام</label>
                    <input type='text' class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{old('first_name')??$user->first_name??''}}" required>
                    @error('first_name')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="last_name" class="form-label"><span class="text-danger">*</span>نام خانوادگی</label>
                    <input type='text' class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{old('last_name')??$user->last_name??''}}" required>
                    @error('last_name')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="mobile" class="form-label"><span class="text-danger">*</span>شماره موبایل</label>
                    <input type='text' class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{old('mobile')??$user->mobile??''}}" required>
                    @error('mobile')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-md-6 col-12 mt-3">
                    <label for="email" class="form-label">ایمیل</label>
                    <input type='text' class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')??$user->email??''}}" >
                    @error('email')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div> --}}            
              
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">ذخیره تغییرات</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">انصراف</button>
            </div>
        </form>
@endsection