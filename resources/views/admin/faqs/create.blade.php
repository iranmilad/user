@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('faqs.store')}}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="question" class="form-label"><span class="text-danger">*</span> پرسش</label>
                    <input type='text' class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{old('question')??''}}" required>
                    @error('question')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="answer" class="form-label"><span class="text-danger">*</span> پاسخ</label>
                    <input type='text' class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" value="{{old('answer')??''}}" required>
                    @error('answer')
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