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

                        @if (auth()->check())


                            <div class="row">
                                Cancel your subscription
                                @if (auth()->user()->braintree_id)

                                    <form action="{{route('subscription.cancel')}}" method="post">
                                        {{csrf_field()}}

                                        <button class="btn btn-block btn-danger" type="submit">Cancel</button>

                                    </form>

                                @endif
                            </div>

                            @if (auth()->user()->subscribed_at)


                                <div class="row">

                                    <b> Next Billing Date </b>: {{  auth()->user()->subscribed_at->addMonth()  }}
                                </div>
                            @endif
                            <div class="row">

                                You are logged in!
                            </div>
                            <div class="row">
                                <a href="{{route('invitation')}}" name="invitation_link" class="btn btn-primary">Send Invitation</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
