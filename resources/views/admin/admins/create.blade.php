@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('admins.store')}}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="first_name" class="form-label">نام</label>
                    <input type='text' class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{old('first_name')??''}}" >
                    @error('first_name')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="last_name" class="form-label">نام خانوادگی</label>
                    <input type='text' class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{old('last_name')??''}}" >
                    @error('last_name')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="mobile" class="form-label">شماره موبایل</label>
                    <input type='text' class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{old('mobile')??''}}" >
                    @error('mobile')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <input type='checkbox' class="@error('supper_admin') is-invalid @enderror" id="supper_admin" name="supper_admin" >
                    <label for="supper_admin" class="form-label">سوپر ادمین</label>
                    @error('supper_admin')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="password" class="form-label"><span class="text-danger">*</span> پسورد</label>
                    <input type='text' class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')??''}}" required>
                    @error('password')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <input type='checkbox' class="@error('active') is-invalid @enderror" id="active" name="active" >
                    <label for="active" class="form-label">فعال</label>
                    @error('active')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">ذخیره تغییرات</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">انصراف</button>
            </div>
        </form>
@endsection