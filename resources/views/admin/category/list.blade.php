<x-admin-app-layout>

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category.create') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                        </div>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa fa-check"></i> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form action="{{ route('category.list') }}" method="GET" class="mb-3">
                        <div class="col-4 offset-8 d-flex">
                            <input type="text" class="form-control" value="{{request('search')}}" name="search" id="" placeholder="Search...">
                            <button type="submit" class="btn btn-dark">
                                Submit
                            </button>
                        </div>
                    </form>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr class="row">
                                    <th class="col-2">ID</th>
                                    <th class="col-4">Category Name</th>
                                    <th class="col-4">Created Date</th>
                                    <th class="col-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse ($categories as $category)
                                    <tr class="tr-shadow row">
                                        <td class="col-2">{{$category->id}}</td>
                                        <td class="col-4">
                                            <span class="block-email">{{$category->name}}</span>
                                        </td>
                                        <td class="col-4">{{$category->created_at->format('j-F-Y')}}</td>
                                        <td class="col-2">
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <a href="{{ route('category.edit',$category->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('category.delete',$category->id) }}" method="POST">@csrf
                                                    @method('DELETE')
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr class="mt-5 bg-white text-black text-center block p-3 shadow-sm">
                                            <td>There is no category</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-2"> {{$categories->appends(request()->query())->links()}}</div>
                        </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

</x-admin-app-layout>
