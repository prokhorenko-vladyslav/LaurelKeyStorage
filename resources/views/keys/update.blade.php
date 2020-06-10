@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Update key "{{ $key->name }}"
                        <a href="{{ route('key.index') }}" class="btn btn-primary">Back</a>
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
                        <form action="{{ route('key.update', $key->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="nameInput">Key name</label>
                                <input type="text" class="form-control" id="nameInput" name="name" required
                                       value="{{ $key->name }}">
                            </div>
                            <div class="form-group">
                                <label for="hostInput">Host</label>
                                <input type="text" class="form-control" id="hostInput" name="host" required
                                       value="{{ $key->host }}">
                            </div>
                            <div class="form-group">
                                <label for="portInput">Port</label>
                                <input type="text" class="form-control" id="portInput" name="port" required
                                       value="{{ $key->port }}">
                            </div>
                            <div class="form-group">
                                <label for="loginInput">Login</label>
                                <input type="text" class="form-control" id="loginInput" name="login" required
                                       value="{{ $key->login }}">
                            </div>
                            <div class="form-group">
                                <label for="passwordInput">Password</label>
                                <input type="text" class="form-control" id="passwordInput" name="password"
                                       value="{{ $key->password }}">
                            </div>
                            <div class="form-group">
                                <label for="fileInput">SSH key</label>
                                <input type="file" class="form-control-file" id="fileInput" name="file">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
