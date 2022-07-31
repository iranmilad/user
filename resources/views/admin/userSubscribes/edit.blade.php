@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('userSubscribes.update',$userSubscribe->id)}}">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="user_id" class="form-label"><span class="text-danger">*</span> آیدی کاربر</label>
                    <input type='text' class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{old('user_id')??$userSubscribe->user_id??''}}" required>
                    @error('user_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="title" class="form-label"><span class="text-danger">*</span> عنوان</label>
                    <input type='text' class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')??$userSubscribe->title??''}}" required>
                    @error('title')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="price" class="form-label"><span class="text-danger">*</span> مبلغ (تومان)</label>
                    <input type='text' class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')??$userSubscribe->price??''}}" required>
                    @error('price')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="payment_gu_id" class="form-label">شناسه پرداخت</label>
                    <input type='text' class="form-control @error('payment_gu_id') is-invalid @enderror" id="payment_gu_id" name="payment_gu_id" value="{{old('payment_gu_id')??$userSubscribe->payment_gu_id??''}}" >
                    @error('payment_gu_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="expire_at" class="form-label">تاریخ پایان</label>
                    <input type='text' class="form-control @error('expire_at') is-invalid @enderror" id="expire_at" name="expire_at" value="{{old('expire_at')??$userSubscribe->expire_at??''}}" >
                    @error('expire_at')
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