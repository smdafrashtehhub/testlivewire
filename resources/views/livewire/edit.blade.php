<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="{{route('test.update',$user->id)}}" method="post" >
    @csrf
    @method('put')
    <div class="form-group w-25">
        <lable for="name">نام</lable>
        <input class="form-control my-3" type="text" name="name" placeholder="نام" value="{{$user->name}}">
        @error('name')
        <span class="">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group w-25">
        <lable for="email">ایمیل</lable>
        <input class="form-control my-3" type="email" name="email" placeholder="ایمیل" value="{{$user->email}}">
    </div>
    <div class="form-group w-25">
        <lable for="sex">مرد</lable>
        <input class=" my-3" type="radio" name="sex" value="male" @if(old('sex')=='male')checked @endif>
        <lable for="sex">زن</lable>
        <input class=" my-3" type="radio" name="sex" value="female" @if(old('sex')=='female')checked @endif>
    </div>
    <div class="form-group w-25">
        <h4 class="">تحصیلات</h4>
        <lable for="diplom">دیپلم</lable>
        <input class=" my-3" type="checkbox" name="tahsilat[]" value="diplom"
               @if(is_array(old('tahsilat')) && in_array('diplom',old('tahsilat')))
               checked
            @endif>
        <lable for="karshenasi">کارشناسی</lable>
        <input class=" my-3" type="checkbox" name="tahsilat[]" value="karshenasi"
               @if(is_array(old('tahsilat')) && in_array('karshenasi',old('tahsilat')))
               checked
            @endif>
    </div>
    <div class="form-group w-25">
        <lable for="password">پسورد</lable>
        <input class="form-control my-3" type="password" name="password">
    </div>
    <button class="btn btn-primary" type="submit">ok</button>
    @foreach($errors->all() as $error)
        <span class="text-danger">{{$error}}</span>
    @endforeach
</form>
</body>
</html>
