<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="w-25 vh-100 m-auto">
    <div class="h-100 w-100 d-flex align-items-center justify-content-center">
        <div class="w-100 card card-style p-5">
            <form action="{{route('login')}}" method="post" class="row">
                @csrf
                <div class="col-12 mt-3">
                    <label for="username" class="form-label"><span class="text-danger">*</span> شماره
                        موبایل</label>
                    <input type='text' class="form-control" id="username" name="username"
                           value="{{old('username')??''}}" required/>
                </div>
                <div class="col-12 mt-3">
                    <label for="password" class="form-label"><span class="text-danger">*</span>رمزعبور</label>
                    <input type='password' class="form-control" id="password" name="password" required/>
                    @error('error')
                    <span class="text-danger font-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-info w-100">ورود</button>
                </div>
            </form>

        </div>
    </div>

</div>

</body>
</html>
