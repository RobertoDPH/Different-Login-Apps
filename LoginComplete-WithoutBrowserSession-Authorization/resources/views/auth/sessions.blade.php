<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sessions</div>
    
                    <div class="card-body">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Agent</th>
                            <th scope="col">IP</th>
                            <th scope="col">Last Activity</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                            <tr>

                                <td>{{ $session->user_agent }}</td>
                                <td>{{ $session->ip_address }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans()}}</td>
                                <td class="text-center">
                                    <button type="button" name="button" class="btn btn-danger delete-session" data-id="{{ $session->id }}">?️</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <button type="button" name="button" class="btn btn-danger delete-all-session" data-id="{{ $session->id }}">Remove all sessions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".delete-session").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                headers: { 'X-CSRF-TOKEN': token },
                url: "/delete-session",
                type: 'POST',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (){
                    location.reload();
                }
            });
        });

        $(".delete-all-session").click(function(){
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                headers: { 'X-CSRF-TOKEN': token },
                url: "/delete-all-session",
                type: 'POST',
                data: {
                    "_token": token,
                },
                success: function (){
                    location.reload();
                }
            });
        });


    </script>

</body>
</html>