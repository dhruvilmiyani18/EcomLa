@include('front.layouts.header');
@yield('slider')

<div id="mainBody">
	<div class="container">
	<div class="row">
		
@yield('content')
		

		</div>
		</div>
	</div>
</div>
@include('front.layouts.footer');