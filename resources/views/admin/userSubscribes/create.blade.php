@extends('admin.layouts.app')

@section('content')
        <form method='post' action="{{route('userSubscribes.store')}}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                   @include("admin.partials.select-user")
                    @error('user_id')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mt-3">
                    <label for="subscribe_id" class="form-label"><span class="text-danger">*</span> اشتراک</label>
                    <select class="form-select @error('subscribe_id') is-invalid @enderror" id="subscribe_id" name="subscribe_id" value="{{old('subscribe_id')??''}}" required>
                    @foreach (App\Models\Subscribe::get(["id","title","price"]) as $subscribe)
                        <option value="{{ $subscribe->id }}" @if((old('subscribe_id')??'')==$subscribe->id) selected @endif>{{ $subscribe->title ." ( ".number_format( $subscribe->price)." تومان )" }}</option>
                    @endforeach
                    </select>
                    @error('title')
                        <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                            
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-info btn-sm">افزودن اشتراک</button>
                <button class="btn btn-secondary btn-sm me-2" data-target='cancel' type="button">انصراف</button>
            </div>
        </form>
@endsection


