@extends('front.layouts.main')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> SHOPPING CART</li>
        </ul>
        @if (session('quantityUpdated'))
            <h6 class="alert alert-info text-center ">{{ session('quantityUpdated') }}</h6>
        @endif
      
        <h3> SHOPPING CART<a href="{{ route('home') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i>
                Continue Shopping </a></h3>
        <hr class="soft" />


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S No</th>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Quantity/Update</th>
                    <th colspan="">Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotal = 0;
                    $i = 0;
                @endphp
                @foreach ($carts as $key => $item)
                    @php
                        $grandTotal = $grandTotal + $item->quantity * $item->product->price;
                        
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td> <img width="100px" src="{{ asset('uploads') . '/' . $item->product->image }}"
                                alt="" />
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            <div class="input-append"><input class="span1" id="quntity-count{{ $key + 1 }}"
                                    value="{{ $item->quantity }}" style="max-width:34px" placeholder="1"
                                    id="appendedInputButtons" size="16" type="text">
                                <a href=""><button class="btn btn-plus"
                                        onclick="quantityIncrement('{{ $item->id }}',{{ $key + 1 }})"
                                        type="button"><i class="icon-plus"></i></button></a>
                                <a href=""><button class="btn btn-minus"
                                        onclick="quantityDecrement('{{ $item->id }}',{{ $key + 1 }})"
                                        type="button"><i class="icon-minus"></i></button></a>
                                <button class="btn btn-danger btn-close" data-id="{{ $item->id }}" type="button"><i
                                        class="icon-remove icon-white"></i></button>
                            </div>
                        </td>
                        <td style="font-size: 15px">₹{{ $item->product->price }}</td>
                        <td style="font-size: 15px">₹{{ $item->quantity * $item->product->price }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" style="text-align:right;font-size: 22px">Total Payable Amounth :</td>
                    <td style="display:block;font-size: 20px"> ₹{{ $grandTotal }}</td>
                </tr>


                <tr>
                    <td colspan="8">
                        {{-- @php
                        $total = 0;
                    @endphp --}}

                        <form method="post" action="{{ route('insert.order') }}" style="text-align: center">
                            @csrf
                            <h3 style="text-align: center">Fill This Details</h3>
                            <input type="text" name="name" id="" placeholder="Enter Full Name" value="{{old('name')}}">
                            @error('name')
                                <span class="text-danger" style="color: brown">{{ $message }}</span>
                            @enderror
                            <textarea name="address" id="" name="address" placeholder="Enter Your Full Addresss ">{{old('address')}}</textarea>
                            @error('address')
                                <span class="text-danger" style="color: brown">{{ $message }}</span>
                            @enderror
                            <input type="text" name="phone" id="" placeholder="Mobail Number" value="{{old('phone')}}">
                            @error('phone')
                                <span class="text-danger" style="color: brown">{{ $message }}</span>
                            @enderror
                            @foreach ($carts as $key => $item)
                                <input type="hidden" name="product_ids[]" value="{{ $item->id }}">
                            @endforeach
                            <input type="submit" class="btn btn-large pull-right btn-danger" name=""
                                value="Order Now" id="">

                        </form>
                    </td>
                </tr>

            </tbody>
        </table>
        <a href="{{ route('home') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>

    </div>
    </div>
    </div>
    </div>
    <!-- MainBody End ============================= -->
@endsection()

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.btn-close').on('click', function() {
            var id = $(this).data('id');
            if (confirm('Are You Sure You Want To Delete This User Data')) {
                $.ajax({
                    url: '{{ route('delete.cart') }}',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });

        function quantityIncrement(qid, QunPosition) {
            var qun = parseInt(document.getElementById('quntity-count' + QunPosition).value);
            qunplus = parseInt(qun + 1);
            $.ajax({
                url: '{{ route('cart') }}',
                data: {
                    'quantityplus': qunplus,
                    'qId': qid
                },
                success: function(data) {
                    // location.reload();
                    console.log(data);
                }
            });
        }

        function quantityDecrement(qid, QunPosition) {
            var qun = parseInt(document.getElementById('quntity-count' + QunPosition).value);
            qunminus = qun - 1;
            // console.log(qun);
            $.ajax({
                url: '{{ route('cart') }}',
                data: {
                    'quantityminus': qunminus,
                    'qId': qid
                },
                success: function(data) {}
            });
        }
    </script>
@endpush

{{-- // function orderNow() {
    //     var cart_id = [];
    //     jQuery('input[name="select_product[]"]:checkbox:checked').each(function(i) {
    //         cart_id[i] = $(this).attr('cart-id');
    //     });
    //     var payment_type = '';
    //     if ($('input[name="eway"]').is(':checked')) {
    //         payment_type = 'eway';
    //     } else {
    //         payment_type = 'pay_person';
    //     }
    //     console.log(cart_id);
    //     if (cart_id.length == 0) {
    //         alert('Please select atleast one product .');
    //     } else {
    //         $.ajax({
    //             url: '{{ route('insert.order') }}',
    //             type: 'post',
    //             data: {
    //                 payment_type: payment_type,
    //                 cart_id: cart_id,
    //                 _token: '{{ csrf_token() }}'
    //             },
    //             success: function(data) {
    //                 location.reload();
    //             }
    //         })
    //     }

    // } --}}
