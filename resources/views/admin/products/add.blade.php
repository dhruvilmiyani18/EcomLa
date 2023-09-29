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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">

            <div class="">
                <div class="col-md-10 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        </label>
                        <div style="margin-left: 330px">
                            <h3 class="text-center">Add Product</h3>

                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif

                            <form id="productForm" data-parsley-validate="" class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name
                                        :</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <span class="text-danger" id="error"></span>
                                        <input type="text" id="name" name="name" data-parsley-required="true"
                                            data-parsley-required-message="This name is required"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Price
                                        :</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input type="text" id="name" name="price"
                                            class="form-control col-md-7 col-xs-12" data-parsley-required="true"
                                            data-parsley-required-message="This price is required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Image
                                        :</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        
                                            <input type="file" class="dropify form-control"  data-height="200"  name="image" id="" placeholder="" aria-describedby="fileHelpId">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Of :
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <select id="name" class="select_dropdown form-control col-md-7 col-xs-12" name="category_id" data-parsley-required="true"
                                            data-parsley-required-message="plase select categry ">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div style="text-align: center; ">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="submit" value="Submit" class="btn btn-success" name=""
                                            id="">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        </label>
                        <div class="table-responsive" style="margin-left: 300px; margin-top:50px;">

                            <form action="{{ route('search.product') }}" class="col-6 " style="margin-bottom: 20px;  ">
                                <div class=" mt-5">
                                    <input style="margin-bottom: 20px;" type="search" class="form-control" name="search"
                                        id="" value="{{ $search }}" aria-describedby="helpId"
                                        placeholder="Search Product Name">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('add.product') }}">
                                        <button class="btn-info btn" type="button">Reset</button>
                                    </a>
                                </div>
                            </form>

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
                                    @php
                                        $serialNumber = ($product->currentPage() - 1) * $product->perPage() + 1;
                                    @endphp
                                    @foreach ($product as $key => $item)
                                        <tr class="">
                                            <td scope="row">{{ $serialNumber++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td><img src="{{ asset('uploads') . '/' . $item->image }}" width="50px"
                                                    height="50px" alt="" alt="img">
                                            </td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td><span><a href="{{ route('edit.product', $item->id) }}"
                                                        class="btn btn-info">Edit</a></span> ||<span>
                                                    <a class="product_delete btn btn-danger"
                                                        data-id="{{ $item->id }}">Delete</a>
                                                    {{-- route('delete.product' --}}

                                                </span></td>
                                            <td><a href="{{ route('product.detail', $item->id) }}"
                                                    class="btn btn-info">Add
                                                    Extra Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>{{ $product->links() }}</div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('product_form')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    //dropify script
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
       
    </script>
    

    <script>
        $(document).ready(function() {
            var form = $('#productForm');

            form.submit(function(e) {
                e.preventDefault();
                // alert('this');
                $('#error').text("");
                var formData = new FormData(this);
                let form = this;
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                $.ajax({
                    type: 'POST',
                    url: "{{ route('store.product') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        location.reload();
                        form.reset();
                        alert('Product Add Successfully !');
                    },
                    error: (response) => {
                        $('#error').text(response.responseJSON.message);
                    }
                });
            });
        });

        $('.product_delete').on('click', function() {
            var id = $(this).data('id');
            if (confirm('Are You Sure You Want To Delete This Category Data')) {
                $.ajax({
                    url: '{{ route('delete.product') }}',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        location.reload();
                        if (data) {
                            alert("Category Delete Successfully !!")
                        }
                    }
                })
            }
        });
    </script>
@endpush
@push('select2_script')
    <script>
        $('.select_dropdown').select2();
    </script>
@endpush