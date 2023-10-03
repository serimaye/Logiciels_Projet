{{--@extends('admin.category.layouts')


@section('content')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            @if (session('message'))
                <div class="alert alert-succes">{{ session('message') }}</div>
            @endif

            <div class="pull-left">

                <h2>Liste des categories de logiciel</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ url('admin/category/create') }}"> Add new Category</a>

            </div>

        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>No</th>

            <th>Nom</th>
            <th>Description</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($categories as $category)
            <tr>

                <td>{{ $category->id }}</td>

                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                   <a href="{{url('admin/category/edit/'.$category->id)}}">Edit</a>
                   <a href="{{url('admin/category/delete/'.$category->id)}}">Supprimer</a>
                </td>

            </tr>
        @endforeach

    </table>


@endsection--}}
@extends('layouts.app')
@section('contents')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @if (session('message'))
                <div class="alert alert-succes">{{ session('message') }}</div>
            @endif
        </div>
    </div>

    {{-- <table class="table table-bordered">

        <tr>

            <th>No</th>
            <th>Nom</th>
            <th>Categorie</th>
            <th>Image</th>
            <th>Version</th>
            <th>Description</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($logiciels as $logiciel)
            <tr>

                <td>{{ $logiciel->id }}</td>
                <td>{{ $logiciel->name }}</td>
                <td>{{ $logiciel->category->name }}</td>
                <td>{{ $logiciel->image }}</td>
                <td>{{ $logiciel->version }}</td>
                <td>{{ $logiciel->description }}</td>
                <td>
                    <a href="{{ url('admin/logiciels/edit/' . $logiciel->id) }}">Edit</a>
                </td>

            </tr>
        @endforeach

    </table> --}}

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2> Les<b>Categories de logiciels</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addNewModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span> Add New Logiciel</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>No</th>
                            <th>Nom</th>
                            <th>Description</th>

                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>

                                <td>

                                    {{--<a href="{{ url('admin/categorys/edit/' . $category->id) }}" class="edit" data-toggle="modal"><i class="material-icons"
                                        data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>--}}

                                    <a href="#deleteModal" class="delete" data-toggle="modal" data-target="#deleteModal{{$category->id}}">
                                        <i class="material-icons" title="Delete">&#xE872;</i>
                                    </a>
                                    <a href="#editModel"class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$category->id}}">
                                        <i class="material-icons" title="Modifier">&#xE254;</i>
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('categories.afficher',$category->id) }}">Details</a>
                                </td>

                            </tr>


                            <!-- La modal de confirmation -->
                            <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$category->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{$category->id}}">Confirmation de suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer cet category ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <form action="{{ route('categories.suppression',$category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Le modal pour l'édition de l'article -->
                            <div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$category->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{$category->id}}">Modifier le category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('categories.modifier', $category->id) }}" method="POST">

                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editer une categorie</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Nom</label>
                                                        <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <textarea type="text" name="description" class="form-control">{{$category->description}}"</textarea>
                                                    </div>

                                                </div>

                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="addNewModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('categories.store')}}" method="POST">

                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Nouveau categorie</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" class="form-control" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"> Supprimer </button>
                        <button type="submit" class="btn btn-success" value="Add" > Ajouter </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

