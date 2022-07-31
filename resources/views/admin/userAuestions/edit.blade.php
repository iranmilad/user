@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('userAuestions.update',$userAuestion->id)}}">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="user_id" class="form-label"><span class="text-danger">*</span> آیدی کاربر</label>
                    <input type='text' class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{old('user_id')??$userAuestion->user_id??''}}" required>
                    @error('user_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="type" class="form-label"><span class="text-danger">*</span> نوع</label>
                    <input type='text' class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{old('type')??$userAuestion->type??''}}" required>
                    @error('type')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="title" class="form-label"><span class="text-danger">*</span> عنوان</label>
                    <input type='text' class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')??$userAuestion->title??''}}" required>
                    @error('title')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="question" class="form-label"><span class="text-danger">*</span> پرسش</label>
                    <input type='text' class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{old('question')??$userAuestion->question??''}}" required>
                    @error('question')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="answerd_at" class="form-label">پاسخ داده شده در</label>
                    <input type='text' class="form-control @error('answerd_at') is-invalid @enderror" id="answerd_at" name="answerd_at" value="{{old('answerd_at')??$userAuestion->answerd_at??''}}" >
                    @error('answerd_at')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="answerd_by" class="form-label">پاسخ داده توسط</label>
                    <input type='text' class="form-control @error('answerd_by') is-invalid @enderror" id="answerd_by" name="answerd_by" value="{{old('answerd_by')??$userAuestion->answerd_by??''}}" >
                    @error('answerd_by')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">save change</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">cancel</button>
            </div>
        </form>
@endsection