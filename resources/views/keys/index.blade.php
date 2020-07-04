@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-0">
                <div class="tab current">
                    <a href="#" class="tab__link border-radius-top-left">
                        FTP/SSH
                        <span class="tab__link__description">FTP or SSH credentials</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 p-0">
                <div class="tab">
                    <a href="#" class="tab__link">
                        Database
                        <span class="tab__link__description">Database credentials</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 p-0">
                <div class="tab">
                    <a href="#" class="tab__link">
                        Admin
                        <span class="tab__link__description">Admin credentials</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 p-0">
                <div class="tab">
                    <a href="#" class="tab__link border-none border-radius-top-right">
                        Hosting
                        <span class="tab__link__description">Hosting credentials</span>
                    </a>
                </div>
            </div>
        </div>
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

                        <keys
                            csrf="{{ csrf_token() }}"
                            :default_keys='@json($keys)'
                        ></keys>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
