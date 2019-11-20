@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="{{route('invitationsendbymail')}}">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Message</label>
                                <textarea  class="form-control"
                                           placeholder="Type Your Message" name="message" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Send Invitation</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="invitation">Invitation Link</label>
                            <input type="text" class="form-control"
                                   value="{{route('referral', [$user->referral_link])}}" readonly>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="sendInvitation" value="Invite People">Invite By Email
                            </button>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Total Users refered by {{auth()->user()->name}}</h4>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="float: right">{{count(auth()->user()->children)}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#sendInvitation').click(function () {
                $('.modal').modal('show');
            });
        });

    </script>
@endsection
