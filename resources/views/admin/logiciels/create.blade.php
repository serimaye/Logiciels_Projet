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



    <form action="{{ url('admin/logiciels') }}" method="POST">

        @csrf



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Nom:</strong>

                    <input type="text" name="name" class="form-control" placeholder="Name">

                </div>

            </div>
            <div>
                <label for="">selectionner une categorie</label>
                <select class="form-control" name="category_id" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Image:</strong>

                    <input type="text" name="image" class="form-control" placeholder="Name">

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Version:</strong>

                    <input type="text" name="version" class="form-control" placeholder="Name">

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Description:</strong>

                    <textarea type="text" class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Enregistrer</button>

            </div>

        </div>
    </form>-->

    <div id="addNewModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('admin/logiciels') }}" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Logiciel</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">selectionner une categorie</label>
                            <select class="form-select" aria-label="Default select example">
                                @foreach (app\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="text" name="image" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Version</label>
                            <input type="text" name="version" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" class="form-control" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add" name="add">
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
