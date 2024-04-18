@extends('master.main')
@section('content')
  <div class="container mt-5" style="margin-bottom: 50px;">
    <div class="card">
      <div class="card-header text-right">
        <h5>Import/Export Options</h5>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="{{url('players/import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-success btn-block">Import</button>
                </form>
            </div>
          <div class="col-md-6">
            <form action="{{url('players/export')}}" method="GET">
                @csrf
                <button type="submit" class="btn btn-success btn-block" id="exportBtn">Export</button>
            </form>
        </div>
        </div>
        <div class="mt-3" style="margin-bottom: 70px;">
          <label for="fileInput">Select Import File:</label>
          <input type="file" class="form-control-file" id="fileInput">
        </div>
      </div>
    </div>
  </div> 
        <div class="container">
            <h1 class="text-center">PLAYERS</h1>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Retired</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td>{{ $player->id }}</td>
                            <td>
                                @if ($player->image)
                                <img class="w-75 img-responsive" src="{{ asset('storage/'.$player->image) }}" alt="" title="">


                                @else
                                    <p>No Image</p>
                                @endif
                            </td>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->address }}</td>
                            <td>
                                @if ($player->retired)
                                    <i class="bi bi-emoji-smile"></i>
                                @else
                                    <i class="bi bi-emoji-smile-upside-down-fill"></i>
                                @endif
                            </td>
                            <td class="d-flex">
                                <a href="{{ url('players/' . $player->id) }}" class="mr-3"><button type="button" class="btn btn-dark">Show</button></a>
                                <a href="{{ url('players/' . $player->id . '/edit') }}" type="button" class="btn btn-dark mr-3">Edit</a>
                                <form action="{{ url('players/' . $player->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="row justify-content-end mt-4">
        <div class="col-auto">
            <form action="{{ url('players/truncate') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-danger">Delete All Players</button>
            </form>
        </div>
    </div>

        <div class="pagination justify-content-center" style="margin-top: 60px;">
                {{ $players->links() }}
            <div>
            </div>
        </div>
    </div>

    
@endsection

