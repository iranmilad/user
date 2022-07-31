<!doctype html>
<html lang="en">
<head>
    <link rel="alternate"
          href="android-app://com.sepehr.moeinfaraji/deep.moeinfaraji.ir" />
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تراکنش ناموفق </title>
    <link rel="icon" href="{{asset('favicon.ico')}}"/>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-icon/bootstrap-icons.css')}}" rel="stylesheet">
</head>
<body>
<!-- checkout------------------------------>
<div class="container-main">

    <div class="row justify-content-center align-items-center mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-x-circle text-danger" style="font-size: 4rem"></i>
                    <h4 class="text-dark mt-0">{{$data->description??"خطا در انجام تراکنش"}}</h4>
                    <a class="btn btn-sm btn-danger mt-3" href="{{ $data->action }}">بازگشت به سایت</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
