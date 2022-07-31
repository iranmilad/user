@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('payments.update',$payment->id)}}">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="gu_id" class="form-label"><span class="text-danger">*</span> شناسه پرداخت</label>
                    <input type='text' class="form-control @error('gu_id') is-invalid @enderror" id="gu_id" name="gu_id" value="{{old('gu_id')??$payment->gu_id??''}}" required>
                    @error('gu_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="user_id" class="form-label"><span class="text-danger">*</span> آیدی کاربر</label>
                    <input type='text' class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{old('user_id')??$payment->user_id??''}}" required>
                    @error('user_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="ref_id" class="form-label"><span class="text-danger">*</span> شناسه پیگیری</label>
                    <input type='text' class="form-control @error('ref_id') is-invalid @enderror" id="ref_id" name="ref_id" value="{{old('ref_id')??$payment->ref_id??''}}" required>
                    @error('ref_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="amount" class="form-label"><span class="text-danger">*</span> مبلغ (تومان)</label>
                    <input type='text' class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{old('amount')??$payment->amount??''}}" required>
                    @error('amount')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="state" class="form-label">وضعیت</label>
                    <input type='text' class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{old('state')??$payment->state??''}}" >
                    @error('state')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="type" class="form-label">نوع</label>
                    <input type='text' class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{old('type')??$payment->type??''}}" >
                    @error('type')
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