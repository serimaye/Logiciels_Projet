@extends('admin.category.layouts')



@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add New Product</h2>

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



<form action="{{ url('admin/logiciels/'.$logiciel->id) }}" method="POST">

    @csrf

    @method('PUT')

     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Nom:</strong>

                <input type="text" name="name" value="{{$logiciel->name}}" class="form-control" placeholder="Name">

            </div>

        </div>
        <div>
            <label for="">selectionner une categorie</label>
            <select name="category_id" id="">
                @foreach ($categories as $category )
                    <option value="{{$category->id}}" {{$logiciel->category_id == $category->id ? 'selected':''}}>
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Image:</strong>

                <input type="text" name="image" value="{{$logiciel->image}}" class="form-control" placeholder="Name">

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Version:</strong>

                <input type="text" name="version" value="{{$logiciel->version}}" class="form-control" placeholder="Name">

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Description:</strong>

                <textarea type="text"  class="form-control" style="height:150px" name="description" placeholder="Description">{{$logiciel->description}}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Enregistrer</button>

        </div>

    </div>



</form>

@endsection
