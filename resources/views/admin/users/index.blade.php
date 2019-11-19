@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-responsive">
                            <thead>
                            <th> Email</th>
                            <th> Brain Tree ID</th>
                            <th> Next subscription Date</th>
                            <th> Past Payments</th>
                            </thead>
                            <tbody>

                            @foreach($users as $user)

                                <tr>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        {{$user->braintree_id}}
                                    </td>

                                    <td>
                                        @if ($user->subscribed_at)

                                            {{$user->subscribed_at->addMonth(1) ?? 'N/A'}}
                                        @else
                                            {{'N/A'}}
                                        @endif
                                    </td>

                                    <td>
                                        @foreach($user->payments as $payment)
                                            Date: {{ $payment->created_at }}
                                            Amount: {{ $payment->amount }}
                                            <br/>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
