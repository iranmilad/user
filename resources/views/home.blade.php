@extends('layouts.app')

@section('content')
    <div class="row h-100">
        <div class="col-md-4">
            <div class="card p-3 h-100">
                <div class="card-title d-flex justify-content-between">
                    <h5>فهرست جدول‌ها</h5>
                    <i class="bi bi-plus-square text-primary cursor-pointer" title="{{__('add new table')}}"></i>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($data as $key=>$item)
                            <li class="table-items p-2 cursor-pointer"><a
                                    href="{{route('home',["table"=>$key])}}">{{$item["alias"]}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3 h-100">
                @if($table=request()->input("table"))
                    <div class="card-title d-flex justify-content-between">
                        <span class="h3">فیلدها</span>
                        <i class="bi bi-plus-square text-primary cursor-pointer" title="{{__('add new row')}}"></i>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>نام</th>
                                    <th>نوع</th>
                                    <th>نوع html</th>
                                    <th>پیشفرض</th>
                                    <th>طول</th>
                                    <th>nullable</th>
                                    <th>auto increment</th>
                                    <th>unique</th>
                                    <th>نمایش در لیست پنل مدیریت</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $index=1;
                            @endphp
                            @foreach($data[$table]["fields"] as $key=>$item)
                                <tr>
                                    <td>{{$index++}}</td>
                                    <td>{{$item["alias"]??$key}}</td>
                                    <td>{{$key}}</td>
                                    <td>{{$item["type"]??""}}</td>
                                    <td>{{$item["html_type"]??""}}</td>
                                    <td>{{$item["default"]??""}}</td>
                                    <td>{{$item["length"]??''}}</td>
                                    <td class="text-center"><input type="checkbox" @if($item["nullable"]??false) checked @endif></td>
                                    <td class="text-center"><input type="checkbox" @if($item["auto_increment"]??false) checked @endif></td>
                                    <td class="text-center"><input type="checkbox" @if($item["is_unique"]??false) checked @endif></td>
                                    <td class="text-center"><input type="checkbox" @if($item["show_in_admin_list_table"]??false) checked @endif></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                @else
                    <div class="card-title d-flex justify-content-between">
                    </div>
                    <div class="card-body">
                        {{__("choose a table")}}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
