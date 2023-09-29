@extends('front.layouts.main')


@section('slider')
<div>
    @if (session('status'))
<h6 class="alert alert-success text-center ">{{ session('status') }}</h6>
@endif
@if (session('message'))
<h6 class="alert alert-danger text-center ">{{ session('message') }}</h6>
@endif
</div>
    <div id="carouselBlk">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="container">
                        <a href="register.html"><img style="width:100%" src="{{ asset('themes/images/carousel/1.png') }}"
                                alt="special offers" /></a>
                        <div class="carousel-caption">
                            <h4>Second Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="container">
                        <a href="register.html"><img style="width:100%" src="{{ asset('themes/images/carousel/2.png') }}"
                                alt="" /></a>
                        <div class="carousel-caption">
                            <h4>Second Thumbnail label</h4>
                            <p>Cras111111 justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="container">
                        <a href="register.html"><img src="{{ asset('themes/images/carousel/3.png') }}" alt="" /></a>
                        <div class="carousel-caption">
                            <h4>Second Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>

                    </div>
                </div>
                <div class="item">
                    <div class="container">
                        <a href="register.html"><img src="{{ asset('themes/images/carousel/4.png') }}" alt="" /></a>
                        <div class="carousel-caption">
                            <h4>Second Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>

                    </div>
                </div>
                <div class="item">
                    <div class="container">
                        <a href="register.html"><img src="{{ asset('themes/images/carousel/5.png') }}" alt="" /></a>
                        <div class="carousel-caption">
                            <h4>Second Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="container">
                        <a href="register.html"><img src="{{ asset('themes/images/carousel/6.png') }}" alt="" /></a>
                        <div class="carousel-caption">
                            <h4>Second Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
    </div>
@endsection()

@section('content')
    <div class="span9">
        <div class="well well-small">
            <h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
            <div class="row-fluid">
                <div id="featured" class="carousel slide">
                    <div class="carousel-inner">

                        @php $i =0; @endphp
                        @foreach ($products->chunk(4) as $product)
                            <div class="item @if ($i == 0) active @endif">
                                @php $i=1; @endphp
                                <ul class="thumbnails">
                                    @foreach ($product as $item)
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <i class="tag"></i>
                                                <a href="{{ route('product_view', $item->id) }}"><img
                                                        src="{{ asset('uploads/') . '/' . $item->image }}"
                                                        alt=""></a>
                                                <div class="caption">
                                                    <h5>{{ $item->name }}</h5>

                                                    <h4><a class="btn"
                                                            href="{{ route('product_view', $item->id) }}">VIEW</a> <span
                                                            class="pull-right"> ₹ {{ $item->price }}</span></h4>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                    </div>
                    <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#featured" data-slide="next">›</a>
                </div>
            </div>

        </div>
        <h4>Latest Products </h4>
        <ul class="thumbnails">
            @foreach ($newProducts as $newProduct)
                <li class="span3" >
                    <div class="thumbnail">
                        <div ><img style="height: 250px; width:100%;"  src="{{ asset('uploads/') . '/' . $newProduct->image }}"
                                alt="" /></div>
                        <div class="caption">
                            <h5>{{ $newProduct->name }}</h5>
                            <p>
                                Lorem Ipsum is simply dummy text.
                            </p>

                            <form action="{{ route('insert.cart') }}" method="post">
                                @csrf
                                <div class="controls">
                                    <input type="hidden" name="product_id" value="{{ $newProduct->id }}" id="">
                                    @if (Auth::User())
											<h4 style="text-align:center"><button class="btn" type="submit">
                                                <i class="icon-zoom-in"></i>Add to <i
                                                    class="icon-shopping-cart"></i></button> <a class="btn btn-primary"> ₹
                                                {{ $newProduct->price }}</a></a></h4>
                                    @else
                                        <h4 style="text-align:center"><a class="btn" href="{{ route('user.login') }}">
                                                <i class="icon-zoom-in"></i> Add to <i
                                                    class="icon-shopping-cart"></i></a> <button class="btn btn-primary"> ₹
                                                {{ $newProduct->price }}</button></h4>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>
    @endsection
