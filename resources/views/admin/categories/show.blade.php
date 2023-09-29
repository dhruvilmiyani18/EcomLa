@extends('admin.layouts.main')

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

        <h6>Follow the command given below</h6>
        <a href=""></a>
       

          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Category Of :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Parent Category Name</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key=>$item)
                        <tr class="">
                            <td scope="row">{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                            @if ($item->category_id)
                            {{$item->parent_category->name}}
                            @else
                                This Is Main Category
                            @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td><a  href="{{route('edit.category',$item->id)}}" class="btn btn-info">Edit</a> || <a  href="{{route('delete.category',$item->id)}}" class="btn btn-danger">Delete</a></td>
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