@extends('layouts.app')
@section('contents')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @if (session('message'))
                <div class="alert alert-succes">{{ session('message') }}</div>
            @endif
        </div>
    </div>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Liste des <b>Logiciels</b></h2>
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
                            <th>Categorie</th>
                            <th>Image</th>
                            <th>Version</th>
                            <th>Description</th>

                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($logiciels as $logiciel)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td>{{ $logiciel->id }}</td>
                                <td>{{ $logiciel->name }}</td>
                                <td>{{ $logiciel->category->name }}</td>
                                <td>{{ $logiciel->image }}</td>
                                <td>{{ $logiciel->version }}</td>
                                <td>{{ $logiciel->description }}</td>
                                <td>

                                    {{--<a href="{{ url('admin/logiciels/edit/' . $logiciel->id) }}" class="edit" data-toggle="modal"><i class="material-icons"
                                        data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>--}}

                                    <a href="#deleteModal" class="delete" data-toggle="modal" data-target="#deleteModal{{$logiciel->id}}">
                                        <i class="material-icons" title="Delete">&#xE872;</i>
                                    </a>
                                    <a href="#editModel" class="edit" data-toggle="modal" data-target="#editModal{{$logiciel->id}}">
                                        <i class="material-icons" title="Modifier">&#xE254;</i>
                                    </a>
                                </td>

                            </tr>


                            <!-- La modal de confirmation -->
                            <div class="modal fade" id="deleteModal{{$logiciel->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$logiciel->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{$logiciel->id}}">Confirmation de suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer cet logiciel ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <form action="{{ route('logiciels.suppression',$logiciel->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal pour l'édition de l'article -->
                            <div class="modal fade" id="editModal{{$logiciel->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{$logiciel->id}}">Editer un logiciel</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('logiciels.modifier', $logiciel->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Nom</label>
                                                        <input type="text" name="name" class="form-control" value="{{$logiciel->name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">selectionner une categorie</label>
                                                        <select class="form-select" name="categorie">
                                                            @foreach (app\Models\Category::all() as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Image</label>
                                                        <input type="text" name="image" class="form-control"value="{{$logiciel->image}}" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Version</label>
                                                        <input type="text" name="version" class="form-control" value="{{$logiciel->version}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <textarea type="text" name="description" class="form-control">{{$logiciel->description}}"</textarea>
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
                <form action="{{route('store')}}" method="POST">

                    @csrf
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
                            <select class="form-select" name="categorie">
                                @foreach (app\Models\Category::all() as $category)
                                    <option value=""></option>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"> Cancel </button>
                        <button type="submit" class="btn btn-success" value="Add" name="add"> Add </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
