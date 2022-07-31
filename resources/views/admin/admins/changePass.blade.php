@extends('admin.layouts.app')

@php
    $shortTitle="تغییر رمز عبور";
    $title="تغییر رمز عبور";
@endphp
@section('title',$title)
@section('css')
@endsection

@section('content')

    <form action="{{route('admin.updatePassword')}}" method="post">
        @csrf
        @method('put')
        <div class="col-md-6 col-sm-12">
            <div class="row mx-3">
                <fieldset class="col-12 form-group">
                    <label for="old_password" class="form-label"><span class="text-danger">*</span> رمز عبور فعلی</label>
                    <input type="password" class="form-control" id="old_password" name="old_password"
                           value="{{@old('first_name')??''}}" required>
                </fieldset>

                <fieldset class="col-12 form-group mt-3">
                    <label for="new_password" class="form-label"><span class="text-danger">*</span> رمز عبور جدید</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </fieldset>

                <fieldset class="col-12 form-group  mt-3">
                    <label for="re_password" class="form-label"><span class="text-danger">*</span> تکرار رمز عبور جدید</label>
                    <input type="password" class="form-control" id="re_password" name="re_password" required>
                </fieldset>
            </div>
        </div>
        <button class="btn btn-primary btn-submit float-left mt-3">تغییر رمز عبور</button>
    </form>
@endsection

@push('modals')

@endpush

@push('scripts')

@endpush
