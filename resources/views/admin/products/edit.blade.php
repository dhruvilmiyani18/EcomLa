@extends('admin.layouts.main')

@push('dropify_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<style>
    .dropify{
        font-size: 20px !important;
    }
</style>
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    
    <div class="x_panel">
      <div class="x_title">
 
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
      
        <h1 class="text-center text-praimary">Edit Product</h1>
       

        <form id="editform" data-parsley-validate="" enctype="multipart/form-data"  class="form-horizontal form-label-left" method="post" action="{{route('update.product',$product->id)}}">
          @csrf
          <div class="form-group">      
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name :</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="name" name="name" value="{{$product->name}}"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">      
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name :</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="name" name="price" value="{{$product->price}}"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">      
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Image :</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {{-- <input type="file" id="name" name="image"   class="form-control col-md-7 col-xs-12"> --}}
              {{-- <input type="file" class="dropify form-control"  data-height="200"  name="image" id="" placeholder="" aria-describedby="fileHelpId"> --}}
              <input type="file" name="image" class="dropify" data-default-file="{{asset('uploads').'/'. $product->image}}">
              {{-- <input type="file" name="image" id=""> --}}
             <div class="mt-3">
                {{-- <img src="{{asset('uploads').'/'. $product->image}}"  width="70px" height="70px" alt="" alt="img"> --}}
             </div>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Category Of :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select  id="name" name="category_id"  class="select_dropdown form-control col-md-7 col-xs-12"> 
               @foreach ($categories as $item)
               <option value="{{$item->id}}" @if( $product->category_id==$item->id)selected  
                @endif>{{$item->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <input type="submit" value="Edit Product" class="btn btn-success" name="" id="">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
    
@endsection

@push('product_form')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
  $('.dropify').dropify();
</script>
    @endpush()
    @push('select2_script')
    <script>
        $('.select_dropdown').select2();
    </script>
@endpush