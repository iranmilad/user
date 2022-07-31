@extends('admin.layouts.app')
@section('content')
        <form method='post' action="{{route('memberLists.update',$memberList->id)}}">
            @csrf
            @method("put")
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <label for="title" class="form-label"><span class="text-danger">*</span> عنوان</label>
                    <input type='text' class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')??$memberList->title??''}}" required>
                    @error('title')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="description" class="form-label"><span class="text-danger">*</span> توضیحات</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{old('class')??$memberList->description??''}}</textarea>
                    @error('description')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                @include("admin.partials.subscribe-accessibility",["data"=>$memberList,"notRefreshTime"=>true])
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">ذخیره تغییرات</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">انصراف</button>
            </div>
        </form>
@endsection