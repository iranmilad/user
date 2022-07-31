<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تراکنش موفق</title>
    <link rel="icon" href="{{asset('favicon.ico')}}"/>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-icon/bootstrap-icons.css')}}" rel="stylesheet">
</head>
<body>
<div class="container-main">
    <div class="row justify-content-center align-items-center mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
{{--                    <form method="{{isset($data->method)?"post":'get'}}" action="{{$data->action??"#"}}">--}}
{{--                        @if(isset($data->method) && $data->method !="get")--}}
{{--                            @csrf--}}
{{--                            @if($data->method !="post")--}}
{{--                                @method($data->method)--}}
{{--                            @endif--}}
{{--                        @endif--}}
                        <input type="hidden" name="amount" value="{{$data->amount??''}}">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem"></i>
                        <h4 class="text-success mt-0">{{$data->description??''}}</h4>
                        <p class="mt-2"><span>کد پیگیری : </span><span>{{$data->refId??''}}</span></p>
                        <a href="{{$data->action??env("APP_URL")}}" class="btn btn-sm btn-success mt-2">بازگشت به سایت</a>
{{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
