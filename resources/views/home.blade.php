@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    @if (Auth::user()->email == 'admin@qubicle.com')
                        <div class="mt-3">Referral Points</div>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>points</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($pointArray as $point)
                              <tr>
                                <td>{{ $point['name'] }}</td>
                                <td>{{ $point['email'] }}</td>
                                <td>{{ $point['point'] }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    @else
                        <div>Your Referral Code : {{ Auth::user()->referral_code }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
