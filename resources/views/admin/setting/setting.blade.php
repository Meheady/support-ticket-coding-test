@extends('admin.layout')
@section('content')
    <div>
        <h6>All Settings</h6>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Email Configuration
                    </div>
                    <div class="card-body">
                        <form id="emailConfigForm" method="POST" action="{{ route('email.config.update') }}">
                            @csrf
                            <div class="form-group">
                                <label >Mail Driver</label>
                                <select class="form-select" name="mail_driver" >
                                    <option {{ $emailConfig->mail_driver ?? '' == 'smtp'?'selected':'' }} value="smtp">SMTP</option>
                                    <option {{ $emailConfig->mail_driver ?? '' == 'pop3'?'selected':'' }} value="pop3">POP3</option>
                                    <option {{ $emailConfig->mail_driver ?? '' == 'imap'?'selected':'' }} value="imap">IMAP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Mail Host</label>
                                <input placeholder="mail_host" required type="text" class="form-control" name="mail_host"
                                       value="{{  $emailConfig->mail_host ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="mail_port">Mail Port</label>
                                <input placeholder="mail_port" required type="text" class="form-control"  name="mail_port"
                                       value="{{  $emailConfig->mail_port??'' }}">
                            </div>
                            <div class="form-group">
                                <label >Mail Username</label>
                                <input placeholder="mail_username" required type="text" class="form-control" name="mail_username"
                                       value="{{  $emailConfig->mail_username??'' }}">
                            </div>
                            <div class="form-group">
                                <label >Mail Password</label>
                                <input placeholder="mail_password" required type="password" class="form-control" name="mail_password"
                                       value="{{  $emailConfig->mail_password??'' }}">
                            </div>
                            <div class="form-group">
                                <label >Mail Encryption</label>
                                <select class="form-select" name="mail_encryption" >
                                    <option {{ $emailConfig->mail_encryption ?? '' == 'ssl'?'selected':'' }} value="ssl">SSL</option>
                                    <option {{ $emailConfig->mail_encryption ?? '' == 'tls'?'selected':'' }} value="tls">TLS</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Mail From Address</label>
                                <input placeholder="mail_from_address" required type="text" class="form-control"  name="mail_from_address"
                                       value="{{ $emailConfig->mail_from_address??'' }}">
                            </div>
                            <div class="form-group">
                                <label >Mail From Name</label>
                                <input placeholder="mail_from_name" required type="text" class="form-control"  name="mail_from_name"
                                       value="{{ $emailConfig->mail_from_name??'' }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Configuration</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
