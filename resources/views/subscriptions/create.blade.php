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

                            <div class="col-md-8 col-md-offset-2">
                                <div id="dropin-container"></div>
                                <button id="submit-button">Request payment method</button>
                                <form id="submitCard" action="{{route('payment.process')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="nonce" value="" id="brainTreeToken">
                                </form>
                            </div>

                        Create New Subscription

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: "{{ $token  }}",
            container: '#dropin-container'
        }, function (createErr, instance) {

            $('#submit-button').click(function (event) {

                instance.requestPaymentMethod(function (err, payload) {

                     $('#brainTreeToken').val(payload['nonce']);
                     $('#submitCard').submit();

                });
            });
        });
    </script>
@endsection
