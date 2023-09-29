@extends('front.layouts.main')

@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{route('home')}}">Home</a> <span class="divider">/</span></li>
		<li class="active">Products Summary</li>
    </ul>
	<h3> {{$category->name}} <span class="pull-right"> {{$products->count()}} products are available </span></h3>	
	<hr class="soft"/>
	<p>
		Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - that is why our goods are so popular and we have a great number of faithful customers all over the country.
	</p>
	<hr class="soft"/>
	<form class="form-horizontal span6">
		<div class="control-group">
		  <label class="control-label alignL">Sort By </label>
			<select>
              <option>Priduct name A - Z</option>
              <option>Priduct name Z - A</option>
              <option>Priduct Stoke</option>
              <option>Price Lowest first</option>
            </select>
		</div>
	  </form>
	  
<div id="myTab" class="pull-right">
 {{-- <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a> --}}
 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
</div>
<br class="clr"/>
<div class="tab-content">
	<div class="tab-pane" id="listView">

			<div class="span2">
				<img src="themes/images/products/3.jpg" alt=""/>
			</div>
			<div class="span4">
				<h3>New | Available</h3>				
				<hr class="soft"/>
				<h5>Product Name </h5>
				<p>
				Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - 
				that is why our goods are so popular..
				</p>
				<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
				<br class="clr"/>
			</div>
			<div class="span3 alignR">
				<form class="form-horizontal qtyFrm">
				<h3> $140.00</h3>
				<label class="checkbox">
				
				
				<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
				<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
				
				</form>
			</div>
		</div>
	
		<hr class="soft"/>
	
		<hr class="soft"/>
		<hr class="soft"/>
	</div>

	<div class="tab-pane  active" id="blockView">
		<ul class="thumbnails">

            @foreach ($products as $item)    
			<li class="span3">
                <div class="thumbnail">
                    <a href="product_details.html"><img src="{{asset('uploads').'/'.$item->image}}" alt=""/></a>
                    <div class="caption">
                        <h5>{{$item->name}}</h5>
                        <h4 style="text-align:center"><a class="btn" href="{{ route('product_view', $item->id) }}"> <i class="icon-zoom-in"></i>Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">&euro;222.00</a></h4>
                    </div>
                </div>
			</li>
            @endforeach

		  </ul>
	<hr class="soft"/>
	</div>
</div>


</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->

@endsection()