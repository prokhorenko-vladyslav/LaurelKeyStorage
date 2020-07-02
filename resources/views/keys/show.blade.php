@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Credentials for {{ $key->name }}
                        <div class="d-flex">
                            <a href="{{ route('key.edit', $key->id) }}" class="btn btn-primary mr-1">Edit</a>
                            <a href="{{ route('key.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Host: <span class="copy" title="Copy" @click="copy('{{ $key->host }}')">{{ $key->host }}</span></li>
                            <li class="list-group-item">Port: <span class="copy" title="Copy" @click="copy('{{ $key->port }}')">{{ $key->port }}</span></li>
                            <li class="list-group-item">Login: <span class="copy" title="Copy" @click="copy('{{ $key->login }}')">{{ $key->login }}</span></li>
                            @if (!empty($key->filepath))
                            <li class="list-group-item">Password: <span class="copy" title="Copy" @click="copy('{{ $key->password }}')">{{ $key->password }}</span>
                            </li>
                            @endif
                            @if (!empty($key->filepath))
                            <li class="list-group-item">File: <a
                                    href="{{ route('key.file', [ 'userId' => $key->user->id, 'keyId' => $key->id]) }}">Download
                                    SSH Key</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copied-success alert alert-success" role="alert" :class="{ 'visible' : copiedSuccess }">
        Success copied
    </div>
@endsection
