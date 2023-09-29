@extends('front.layouts.main')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{route('home')}}">Home</a> <span class="divider">/</span></li>
            <li class="active">Login</li>
        </ul>
        <h3> Login</h3>
        <hr class="soft" />

        <div class="row">

        </div>
        <div class="span1"> &nbsp;</div>
        <div class="span4">
            <div class="well">
                <h3>LOGIN YOUR ACCOUNT</h3>
                @if (session('status'))
                    <h6 class="alert alert-danger text-center ">{{ session('status') }}</h6>
                @endif
                <form action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <div class="control-group">
                        <label class="control-label" for="inputEmail1">Email</label>
                        <div class="controls">
                            <input class="span3" name="email" type="text" id="inputEmail1" placeholder="Email">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword1">Password</label>
                        <div class="controls">
                            <input type="password" name="password" class="span3" id="inputPassword1"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">LOGIN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- MainBody End ============================= -->
@endsection()
