<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="text-center mt-5">
        <h2>Add team</h2>

        <form class="row g-3 justify-content-center" method="POST" action="{{route('teams.store')}}">
            @csrf
            <div class="col-6">
                <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Добавить</button>
            </div>
        </form>
    </div>

    <div class="text-center">
        <h2>All teams</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $counter=1 @endphp

                        @foreach($teams as $team)
                        <tr>
                            <th>{{$counter}}</th>
                            <td>{{$team->title}}</td>
                            <td>{{$team->created_at}}</td>
                            <td>
                                @if($team->is_completed)
                                <div class="badge bg-success">Completed</div>
                                @else
                                <div class="badge bg-warning">Not Completed</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('teams.edit',['team'=>$team->id])}}" class="btn btn-info">Edit</a>
                                <a href="{{route('teams.destroy',['team'=>$team->id])}}" class="btn btn-danger">Delete</a>
                                <a href="{{route('tasks.edit',['team'=>$team->id])}}" class="btn btn-success">Add</a>
                            </td>
                        </tr>

                        @php $counter++; @endphp

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
            @endforeach
            @endif
        </div>
    </div>
</body>

</html>