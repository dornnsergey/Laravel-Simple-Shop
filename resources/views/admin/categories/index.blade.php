@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h1>Categories</h1>
        @if(session('message'))
            <div class="alert alert-warning">{{ session('message') }}</div>
        @endif
        <table class="table table-striped">
            <tbody>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th class="col-md-4">Действия</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('admin.categories.show', $category) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('admin.categories.edit', $category) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a class="btn btn-success" type="button"
           href="{{ route('admin.categories.create') }}">Добавить категорию</a>
    </div>
@endsection
