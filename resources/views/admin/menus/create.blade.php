@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('menus.store')}}">
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
                    <label for="key" class="form-label"><span class="text-danger">*</span> شناسه</label>
                    <input type='text' class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{old('key')??''}}" required>
                    @error('key')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                @include("admin.partials.subscribe-accessibility",["notRefreshTime"=>true])
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">ذخیره تغییرات</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">انصراف</button>
            </div>
        </form>
@endsection