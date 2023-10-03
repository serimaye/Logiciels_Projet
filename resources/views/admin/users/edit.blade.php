@extends('admin.category.layouts')



@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Modifier vos informations</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ url('admin/logiciels') }}"> Back</a>

        </div>

    </div>

</div>



@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif



<form action="{{ url('admin/users/'.$user->id) }}" method="POST">

    @csrf

    @method('PUT')

     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Nom:</strong>

                <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Name">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Email:</strong>

                <input type="text" name="image" value="{{$user->email}}" class="form-control" placeholder="Name">

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Enregistrer</button>

        </div>

    </div>



</form>

@endsection
