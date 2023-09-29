@extends('admin.layouts.main')

@push('dropify_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <style>
        .dropzone.dz-clickable .dz-message,
        .dropzone.dz-clickable .dz-message * {
            cursor: pointer;
            font-size: 25px;
        }

        .dropzone {
            min-height: 150px !important;
            border: 1px dashed #4e4b4bc6 !important
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

                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left"
                        enctype="multipart/form-data" method="post" action="{{ route('product.details') }}">
                        @csrf
                        <h1 class="text-center">Add Extra Details</h1>
                        <input type="hidden" id="name" name="product_id" value="{{ $id }}"
                            class="form-control col-md-7 col-xs-12">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Title :</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="title"
                                    value="{{ @$product->product_details->title }}" class="form-control col-md-7 col-xs-12">
                                @error('title')
                                    <span class="text-danger" style="color: brown">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Quantity
                                :</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="quantity"
                                    value="{{ @$product->product_details->quantity }}"
                                    class="form-control col-md-7 col-xs-12">
                                @error('quantity')
                                    <span class="text-danger" style="color: brown">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product
                                Description:</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" name="description" id="" rows="3">{{ @$product->product_details->description }}</textarea>
                                @error('description')
                                    <span class="text-danger" style="color: brown">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Extra Image :</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    @if (!@$product->product_details)
                                    <div class="needsclick dropzone" id="document-dropzone" >
                                        </div>
                                    </div>
                                    @endif
                                    @error('image')
                                        <span class="text-danger" style="color: brown">{{ $message }}</span>
                                    @enderror

                                    @if (@$product->product_details->image)
                                        @foreach ($images as $item)
                                            <img src="{{ asset('productmulti_img') . '/' . $item }}" alt="img"
                                                width="50px" height="50px">       
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    @if (!@$product->product_details)
                                        <input type="submit" value="Submit" class="btn btn-success" name=""
                                            id="">
                                    @endif
                                </div>
                            </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('product_form')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    {{-- ...Some more scripts... --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('projects.storeMedia') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="image[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($project) && $project->document)
                    var files =
                        {!! json_encode($project->document) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '"    >')
                    }
                @endif
            }
        }
    </script>
@endpush
