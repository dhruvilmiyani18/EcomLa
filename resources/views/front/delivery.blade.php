@extends('front.layouts.main')

@section('content')
    <div class="span9" id="mainCol">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> Oder Details</li>
        </ul>
        @if (session('success'))
        <h6 class="alert alert-success text-center ">{{ session('success') }}</h6>
    @endif
        @if (session('oderstatus'))
        <h6 class="alert alert-info text-center ">{{ session('oderstatus') }}</h6>
    @endif
    <div class="table-responsive">
        <table class="table table-striped
        table-hover	
        table-borderless
        table-primary
        align-middle">
            <thead class="table-light">
              
                <h3 class="text-center">ODER DETAILS</h3>
                <tr>
                    <th>Sr No</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Total Payment</th>
                    <th>Oder Status</th>
                    <th>Payment Status</th>
                    <th>Req Cancle Oder</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($oder_details as $key => $item)
                    <tr class="table-primary" > 
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td><img src="{{asset('uploads').'/'.$item->product->image}}" alt="product img" width="
                            50px"></td>
                            <td>{{$item->product->price}}</td>
                            <td>{{$item->product->price * $item->quantity}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->payment_status}}</td>
                            <td><a href="javascript:void(0)" class="btn btn-danger delete-oder" data-id="{{$item->id}}" >Cancle Oder</a></td>
                    </tr>
                    @endforeach
                  
                </tbody>
                <tfoot>
                    
                </tfoot>
        </table>
    </div>
    
    
    </div>
    <!-- MainBody End ============================= -->
@endsection()


@push('script')

    <script>
        $('.delete-oder').on('click', function() {
            var id = $(this).data('id');
            if (confirm('Are You Sure You Want To Cancle Your Oder')) {
                $.ajax({
                    url: '{{ route('oder.cancle') }}',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });
    </script>
@endpush    