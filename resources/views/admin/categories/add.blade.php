@extends('admin.layouts.main')
@push('select2')
    
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
                            <h3 class="text-center">Add Category</h3>
                            <form id="category_form" data-parsley-validate="" class="form-horizontal form-label-left">
                                @csrf
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Name
                                    :</span>
                                </label>
                                <input type="text" id="name" name="name" data-parsley-required="true"
                                    data-parsley-required-message="Please enter category name."
                                    class="form-control col-md-7 col-xs-12">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Category :
                                </label>
                              

                                <select  class="select_dropdown form-control col-md-7 col-xs-12" style=""  class="" name="category_id">
                                    <option value="">No Sub Category</option>
                                    <optgroup label="Sub Category Of :">
                                        @foreach ($categories as $ct)
                                            <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>


                                <div style="text-align: center; "> <input type="submit" style="margin: 20px !important;"
                                        value="Submit" class="btn btn-success m-2" name="" id="category-form-submit">
                                </div>
                            </form>
                        </div>

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        </label>
                        <div class="table-responsive" style="margin-left: 300px; margin-top:50px;">

                            <form action="{{ route('search.category') }}" class="col-6 " style="margin-bottom: 20px;  ">
                                <div class=" mt-5">
                                    <input style="margin-bottom: 20px;" type="search" class="form-control" name="search"
                                        id="" value="{{ $search }}" aria-describedby="helpId"
                                        placeholder="Search Category Name">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('add.category') }}">
                                        <button class="btn-info btn" type="button">Reset</button>
                                    </a>
                                </div>
                            </form>

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
                                    @php
                                        $serialNumber = ($category->currentPage() - 1) * $category->perPage() + 1;
                                    @endphp

                                    @foreach ($category as $key => $item)
                                        <tr class="">
                                            <td scope="row">{{ $serialNumber++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->category_id)
                                                    {{ $item->parent_category->name }}
                                                @else
                                                    This Is Main Category
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{ route('edit.category', $item->id) }}"
                                                    class="btn btn-info">Edit</a> ||
                                                <a class="category_delete btn btn-danger"
                                                    data-id="{{ $item->id }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>{{ $category->links() }}</div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('form_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script>
        jQuery('#category_form').submit(function(e) {
            e.preventDefault();
            // alert('data');
            let formData = jQuery(this).serialize();
            let form = this;
            jQuery.ajax({
                url: '{{ route('store.category') }}',
                type: 'post',
                data: formData,
                success: function(result) {
                    // console.log(result);
                    location.reload();
                    alert('Category Add Succesfully !')
                    form.reset();
                }
            });
        });

        $('.category_delete').on('click', function() {
            var id = $(this).data('id');
            if (confirm('Are You Sure You Want To Delete This Category Data')) {
                $.ajax({
                    url: '{{ route('delete.category') }}',
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
