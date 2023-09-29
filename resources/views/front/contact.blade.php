@extends('front.layouts.main2')

@section('content')
<div id="mainBody">
<div class="container">
	@if (session('status'))
	<h6 class="alert alert-success text-center ">{{ session('status') }}</h6>
@endif
	<hr class="soften">
	<h1>Visit us</h1>
	<hr class="soften"/>	
	<div class="row">
		<div class="span4">
		<h4>Contact Details</h4>
		<p>	18 Fresno,<br/> CA 93727, IND
			<br/><br/>
			ecom12@.com<br/>
			﻿Tel 123-456-6780<br/>
			Fax 123-456-5679<br/>
		</p>		
		</div>
			
		<div class="span4">
		<h4>Opening Hours</h4>
			<h5> Monday - Friday</h5>
			<p>09:00am - 09:00pm<br/><br/></p>
			<h5>Saturday</h5>
			<p>09:00am - 07:00pm<br/><br/></p>
			<h5>Sunday</h5>
			<p>12:30pm - 06:00pm<br/><br/></p>
		</div>
		<div class="span4">
		<h4> Send Any Suggestion / Message</h4>
		<form action="{{route('contact.message')}}" method="POST" class="form-horizontal">
			@csrf
        <fieldset>
          <div class="control-group">
              <input type="text" name="name" placeholder="name" value="{{old('name')}}" class="input-xlarge"/></br>
			  @error('name')
			  <span class="text-danger" style="color: brown">{{ $message }}</span>
		    @enderror
          </div>
		   <div class="control-group">
              <input type="text" name="email" placeholder="email" value="{{old('email')}}" class="input-xlarge"/></br>
			  @error('email')
			  <span class="text-danger" style="color: brown">{{ $message }}</span>
		    @enderror
          </div>
		   <div class="control-group">
              <input type="text" name="subject" placeholder="subject" value="{{old('subject')}}" class="input-xlarge"/></br>
			  @error('subject')
			  <span class="text-danger" style="color: brown">{{ $message }}</span>
		    @enderror
          </div>
          <div class="control-group">
              <textarea rows="3" name="message" id="textarea" class="input-xlarge">{{old('message')}}</textarea></br>
			  @error('message')
			  <span class="text-danger" style="color: brown">{{ $message }}</span>
		    @enderror
          </div>
            <button class="btn btn-large" type="submit">Send Messages</button>
        </fieldset>
      </form>
		</div>
	</div>
	<div class="row">
	<div class="span12">

		<iframe	src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.0038258668296!2d72.86365461087803!3d21.231696880695953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f3c8840ae65%3A0xe447279a17c1f6c2!2sVIP%20Cir%2C%20Uttran%2C%20Surat%2C%20Gujarat%20394105!5e0!3m2!1sen!2sin!4v1695099400093!5m2!1sen!2sin"
		width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
		referrerpolicy="no-referrer-when-downgrade" style="color:#0000FF;text-align:left"></iframe>
	</div>
	</div>
</div>
</div>
<!-- MainBody End ============================= -->
@endsection() 