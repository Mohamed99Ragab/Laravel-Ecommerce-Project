<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
</head>
<body>

    <h3>Hi Admin request new contact us info</h3>

    <table class="table">
        <thead>
        <tr>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$name}}</td>
            <td>{{$email}}</td>
            <td>{{$phone}}</td>
        </tr>

        </tbody>
    </table>

    <hr>
    <strong>subject:</strong>
    <p>{{$subject}}</p>
    <br>
    <strong>message:</strong>
    {{$messa}}

</body>
</html>
