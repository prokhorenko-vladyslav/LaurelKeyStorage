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
                            <li class="list-group-item">Host: <span onclick="copy(this)">{{ $key->host }}</span></li>
                            <li class="list-group-item">Port: <span onclick="copy(this)">{{ $key->port }}</span></li>
                            <li class="list-group-item">Login: <span onclick="copy(this)">{{ $key->login }}</span></li>
                            <li class="list-group-item">Password: <span onclick="copy(this)">{{ $key->password }}</span>
                            </li>
                            <li class="list-group-item">File: <a
                                    href="{{ route('key.file', [ 'userId' => $key->user->id, 'keyId' => $key->id]) }}">Download
                                    SSH Key</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copy(copyText) {
            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Copied the text: " + copyText.value);
        }
    </script>
@endsection
