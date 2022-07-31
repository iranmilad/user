@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('charts.update',$chart->id)}}">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="title" class="form-label"><span class="text-danger">*</span> عنوان</label>
                    <input type='text' class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')??$chart->title??''}}" required>
                    @error('title')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="key" class="form-label"><span class="text-danger">*</span> شناسه</label>
                    <input type='text' class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{old('key')??$chart->key??''}}" required>
                    @error('key')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
              
                <div class="col-md-6 col-12 mt-3">
                    <label for="refresh_time" class="form-label"><span class="text-danger">*</span> رفرش تایم (دقیقه)</label>
                    <input type='number' class="form-control @error('refresh_time') is-invalid @enderror" id="refresh_time" name="refresh_time" value="{{old('refresh_time')??$chart->refresh_time??''}}" required>
                    @error('refresh_time')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>             
                <div class="col-md-6 col-12 mt-3">
                    <label for="feeder_url" class="form-label">feeder url</label>
                    <input type='text' class="form-control @error('feeder_url') is-invalid @enderror" id="feeder_url" name="feeder_url" value="{{old('feeder_url')??$chart->feeder_url??''}}" >
                    @error('feeder_url')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                @include("admin.partials.subscribe-accessibility",["data"=>$chart])
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">ذخیره تغییرات</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">انصراف</button>
            </div>
        </form>
@endsection