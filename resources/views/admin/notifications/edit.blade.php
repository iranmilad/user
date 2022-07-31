@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('notifications.update',$notification->id)}}">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="title" class="form-label"><span class="text-danger">*</span> عنوان</label>
                    <input type='text' class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')??$notification->title??''}}" required>
                    @error('title')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="text" class="form-label"><span class="text-danger">*</span> متن</label>
                    <input type='text' class="form-control @error('text') is-invalid @enderror" id="text" name="text" value="{{old('text')??$notification->text??''}}" required>
                    @error('text')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="type" class="form-label">نوع</label>
                    <input type='text' class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{old('type')??$notification->type??''}}" >
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