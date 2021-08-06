@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('verified'))
                        <div class="alert alert-success" role="alert">
                            Successfully verified your email!
                        </div>
                    @endif

                    <table class="table">
                        @foreach($user->toArray() as $key => $value)
                            <tr>
                                <th>{{ __("messages." . $key) }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
