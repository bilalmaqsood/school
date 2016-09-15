@extends('layouts.login')
@section('content')
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <div id="wrapper">
        <div class="animate form">
            <section class="login_content">
                <form method="post" action="{{ url('user/signin')}}" >
                    <h1>Login</h1>
                    @if(Session::has('message'))
                        {!! Session::get('message') !!}
                    @endif
                    <div>
                        <input name="email" type="email" class="form-control" placeholder="Email" required="email" />
                    </div>
                    <div>
                        <input name="password" type="password" class="form-control" placeholder="Password" required="true" />
                    </div>
                    <div>
                        <button class="btn btn-block btn-default submit">Log in</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw" style="font-size: 26px;"></i> {{ CNF_APPNAME }}</h1>
                        </div>
                    </div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
    </div>
@stop