@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Keys
                        <a href="{{ route('key.create') }}" class="btn btn-primary">Add</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($errors->count())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error }}
                                </div>
                            @endforeach
                        @endif

                        <ul class="list-group list-group-flush">
                            @foreach($keys as $key)
                                <li class="list-group-item d-flex justify-content-between">
                                    {{ $key->name }}
                                    <div class="d-flex">
                                        <a href="{{ route('key.show', $key->id) }}"
                                           class="btn btn-primary mr-3">Show</a>
                                        <a href="{{ route('key.edit', $key->id) }}"
                                           class="btn btn-primary mr-3">Edit</a>
                                        <form action="{{ route('key.destroy', $key->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                {{ $keys->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
