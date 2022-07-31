@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('subscribes.store')}}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="title" class="form-label"><span class="text-danger">*</span> عنوان</label>
                    <input type='text' class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')??''}}" required>
                    @error('title')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="price" class="form-label"><span class="text-danger">*</span> مبلغ (تومان)</label>
                    <input type='text' class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')??''}}" required>
                    @error('price')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="period" class="form-label"><span class="text-danger">*</span> دوره (روز)</label>
                    <input type='number' class="form-control @error('period') is-invalid @enderror" id="period" name="period" value="{{old('period')??''}}" required>
                    @error('period')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="description" class="form-label"><span class="text-danger">*</span> توضیحات</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{old('description')??''}}</textarea>
                    @error('description')
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