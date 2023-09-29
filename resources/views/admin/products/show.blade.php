@extends('admin.layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    
    <div class="x_panel">
      <div class="x_title">
        @if(session('status'))
        <h1 class="alert alert-success text-center" style="color: green">{{session('status')}}</h1>
        @endif
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
 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Action</th>              
                            <th scope="col">Add Extra Details</th>              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $key=>$item)
                        <tr class="">
                            <td scope="row">{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td><img src="{{asset('uploads').'/'. $item->image}}" width="50px" height="50px" alt="" alt="img"></td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td><span><a  href="{{route('edit.product',$item->id)}}" class="btn btn-info">Edit</a></span> ||<span><a  href="{{route('delete.product',$item->id)}}" class="btn btn-danger">Delete</a></span></td>
                            
                            <td><a href="{{route('product.detail',$item->id)}}" class="btn btn-info">Add Extra Details</a></td>
                        </tr>                 
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            </div>
          </div>
    
      </div>
    </div>
  </div>
</div>
    
@endsection

{{-- @push('footer-script')
<script>
  $('.delete1').on('click',function(){
    if(confirm("Are You Delete This Product")){
      var id = $(this).data('id');
      $.ajex({
        url: '{{route('delete.product')}}',
        method : 'post',
        data : {
          _token :"{{csrf_token()}}",
          'id':id
        },
        success : function(data){
          location.reload(data);
        }
      })

    }
  })
</script>
    
@endpush --}}