@extends('front.layouts.main')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{route('home')}}">Home</a> <span class="divider">/</span></li>
            <li class="active">Register</li>
        </ul>
        <hr class="soft" />
        <div class="row">
        </div>
        <div class="span1"> &nbsp;</div>
        <div class="span4">
            
            <div class="span4">
                <div class="well">
                    <h3>REGISTER DATA</h3>
                    @if(session('status'))
                <h6 class="alert alert-success text-center " >{{session('status')}}</h6>
                @endif
                    <form action="{{ route('user.register') }}" method="POST">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="inputEmail1">First Name</label>
                            <div class="controls">
                                <input class="span3" name="fname" type="text" id="inputEmail1"
                                    placeholder="Enter Your First Name" value="{{old('fname')}}"></br>
                                    @error('fname')
                                    <span class="text-danger" style="color: brown">{{ $message }}</span>
                                  @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail1">Last Name</label>
                            <div class="controls">
                                <input class="span3" name="Lname" type="text" id="inputEmail1"
                                    placeholder="Enter Your Last Name" value="{{old('Lname')}}"></br>
                                    @error('Lname')
                                    <span class="text-danger" style="color: brown">{{ $message }}</span>
                                  @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail1">Email</label>
                            <div class="controls">
                                <input class="span3" name="email" type="text" id="inputEmail1" placeholder="Email" value="{{old('email')}}"></br>
                                @error('email')
                                <span class="text-danger" style="color: brown">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword1">Password</label>
                            <div class="controls">
                                <input type="password" name="password" class="span3" id="inputPassword1"
                                    placeholder="Password" value="{{old('password')}}"></br>
                                    @error('password')
                                    <span class="text-danger" style="color: brown">{{ $message }}</span>
                                  @enderror
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">REGISTER</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
    <!-- MainBody End ============================= -->
@endsection()
