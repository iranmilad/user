@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('userNotifications.store')}}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="user_id" class="form-label"><span class="text-danger">*</span> آیدی کاربر</label>
                    <input type='text' class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{old('user_id')??''}}" required>
                    @error('user_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="notification_id" class="form-label"><span class="text-danger">*</span> آیدی نوتیفیکیشن</label>
                    <input type='text' class="form-control @error('notification_id') is-invalid @enderror" id="notification_id" name="notification_id" value="{{old('notification_id')??''}}" required>
                    @error('notification_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="seen_at" class="form-label">خوانده شده در</label>
                    <input type='text' class="form-control @error('seen_at') is-invalid @enderror" id="seen_at" name="seen_at" value="{{old('seen_at')??''}}" >
                    @error('seen_at')
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