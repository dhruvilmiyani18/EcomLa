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

                    <h1 class="text-center text-praimary">Edit Category</h1>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method="post"
                        action="{{ route('update.category', $category->id) }}">
                        @csrf
                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Name :</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" value="{{ $category->name }}"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Category Of :
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <select  class="select_dropdown form-control col-md-7 col-xs-12" style=""
                                    class="" name="category_id">
                                    <option value="" @if ($category->category_id == null) selected @endif>No Sub Category
                                    <optgroup label="Sub Category Of :">
                                      @foreach ($categories as $item)
                                      <option value="{{ $item->id }}"
                                          @if ($category->category_id != null && $category->category_id == $item->id) selected @endif>{{ $item->name }}</option>
                                  @endforeach
                                    </optgroup>
                                </select>

                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">


                                <input type="submit" value="Submit" class="btn btn-success" name="" id="">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('select2_script')
    <script>
        $('.select_dropdown').select2();
    </script>
@endpush
