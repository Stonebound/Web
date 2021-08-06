@extends('layouts.app')

@section('title', '404')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-warning">
                <strong>Page Not Found</strong>
                <div>You seem to have stumbled upon a page that does not exist. Return to the <a href="/">home page</a>.</div>
            </div>
        </div>
    </div>
</div>
@endsection
