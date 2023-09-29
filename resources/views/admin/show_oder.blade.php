@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    @if (session('message'))
                        <h1 class="alert alert-success text-center" style="color: green">{{ session('message') }}</h1>
                    @endif
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-primary">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.no</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Oder Date</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Qyt</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Payment </th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Phone No</th>
                                        
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($all_oder as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td scope="row">{{ $item->product->name}}</td>
                                                <td scope="row">{{ $item->user->name }}</td>
                                                 <td scope="row">{{ $item->user->email }}</td>
                                                 <td scope="row">{{get_formatted_date($item->created_at,"d-M-Y") }}</td> 
                                                 <td scope="row">₹{{ $item->price }}</td>
                                                 <td scope="row">{{ $item->quantity}}</td>
                                                 <td scope="row">₹{{ $item->sub_total }}</td>
                                                 <td scope="row">{{ $item->payment_status}}</td>
                                                 <td scope="row">
                                                    @php
                                                        $status = $item->status;
                                                    @endphp
                                                   
                                                    <select name="" class="book_status" data-id="{{$item->id}}">
                                                        <option value="pending" @if ($status == 'pending') selected @endif>pending</option>
                                                        <option value="accepted" @if ($status == 'accepted') selected @endif>accepted</option>
                                                        <option value="rejected" @if ($status == 'rejected') selected @endif>rejected</option>
                                                        <option value="delivered" @if ($status == 'delivered') selected @endif>delivered</option>
                                                    </select>
                                                 </td>
                                                 <td scope="row">{{ $item->name }}</td>
                                                 <td scope="row">{{ $item->address }}</td>
                                                 <td scope="row">{{ $item->phone }}</td>
                                              
                                                <td>
                                                    <a href="javascript::void(0)" class="delete-item " data-id="{{ $item->id }}"><i class="material-icons" style="font-size:26px; color:red;">delete</i></a>
                                                </td>
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

@push('script')

    <script>
            $('.delete-item').on('click', function() {
                var id = $(this).data('id');
                if (confirm('Are You Sure You Want To Delete This User Data')) {
                    $.ajax({
                        url: '{{route("delete.oder")}}',
                        data: {
                            id: id 
                        },
                        success: function(data) {
                           location.reload();
                           }
                    });
                }
            });

            $('.book_status').on('change',function(){
                var status = $(this).val();
                var id = $(this).data('id');
                $.ajax({
                    url :'{{route("oder.status")}}',
                    data : {
                        id : id,
                        status : status,
                    },
                    success : function(data){
                        location.reload();
                    }
                })
            });
   
    </script>
@endpush
