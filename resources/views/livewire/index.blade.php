<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th>نام</th>
        <th>ایمیل</th>
        <th>حذف</th>
        <th>ویرایش</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>
            <form action="{{route('test.destroy',$user->id)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">حذف</button>
            </form>
        </td>
        <td>
            <form action="{{route('test.edit',$user->id)}}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary">ویرایش</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
