@extends('layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Apps</h2>
            </div>
            <div class="pull-right" style="margin-bottom:10px;">
            <a class="btn btn-success" href="{{ url('create') }}"> Create New Restaurant</a>
            </div>
        </div>
    </div>
     
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Number</th>
            <th>Email</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($restaurants as $restaurant)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/images/{{ $restaurant->image }}" width="100px"></td>
            <td>{{ $restaurant->name }}</td>
            <td>{{ $restaurant->number }}</td>
            <td>{{ $restaurant->email }}</td>
            <td>{{ $restaurant->detail }}</td>
            <td>
                <form action="{{ route('destroy',$restaurant->id) }}" method="POST">
                    {{ csrf_field()  }}
                    @method('DELETE')
                    <a class="btn btn-info" href="{{ route('show',$restaurant->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('edit',$restaurant->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
     
    {!! $restaurants->links() !!}
 
@endsection