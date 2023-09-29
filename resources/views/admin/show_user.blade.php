@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    @if (session('status'))
                        <h1 class="alert alert-success text-center" style="color: green">{{ session('status') }}</h1>
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
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="table-responsive">

                                <form action="{{route('search.user')}}" class="col-6 " style="margin-bottom: 20px;  ">
                                    <div class=" mt-5">
                                        <input style="margin-bottom: 20px;"  type="search" class="form-control" name="search" id="" value="{{$search}}" aria-describedby="helpId" placeholder="Search Category Name">
                                       <button type="submit" class="btn btn-primary">Submit</button>
                                       <a href="{{route('show.user')}}">
                                        <button class="btn-info btn" type="button">Reset</button>
                                       </a>
                                    </div>
                            </form> 

                                <table class="table table-primary">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.no</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Created Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $serialNumber = ($userdata->currentPage() - 1) * $userdata->perPage() + 1;
                                    @endphp
                                        @foreach ($userdata as $key => $item)
                                            <tr>
                                                <td>{{ $serialNumber ++ }}</td>
                                                <td scope="row">{{ $item->name }}</td>
                                                <td scope="row">{{ $item->email }}</td>
                                                <td scope="row">{{ $item->created_at }}</td>
                                                <td>
                                                    <a href="javascript::void(0)" class="delete-item " data-id="{{ $item->id }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>{{ $userdata->links() }}</div>       
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
                        url: '{{route("delete.user")}}',
                        method: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
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
