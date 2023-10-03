@extends('admin.category.layouts')


@section('content')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            @if (session('message'))
                <div class="alert alert-succes">{{ session('message') }}</div>
            @endif

            <div class="pull-left">

                <h2>Liste des utilisateurs</h2>

            </div>

        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>No</th>

            <th>Nom</th>
            <th>Email</th>
            <th width="280px">Action</th>

        </tr>

        @foreach ($users as $user)
            <tr>

                <td>{{ $user->id }}</td>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                   <a href="{{url('admin/users/delete/'.$user->id)}}">Supprimer</a>
                   <a href="{{url('admin/users/edit/'.$user->id)}}">Editer</a>
                </td>

            </tr>
        @endforeach

    </table>
@endsection
