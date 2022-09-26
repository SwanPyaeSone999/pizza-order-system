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
                               <h2 class="title-1">Pizzas List</h2>
                           </div>
                       </div>
                       <div class="table-data__tool-right">
                           <a href="{{ route('pizza.create') }}">
                               <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                   <i class="zmdi zmdi-plus"></i>Add Pizza
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

                   <form action="{{ route('pizza.list') }}" method="GET" class="mb-3">
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
                                   <th class="col-2">Photo</th>
                                   <th class="col-2">Pizza Name</th>
                                   <th class="col-2">Category</th>
                                   <th class="col-1">Price</th>
                                   <th class="col-1">View Count</th>
                                   <th class="col-2">Created Date</th>
                                   <th class="col-2">Action</th>
                               </tr>
                           </thead>
                           <tbody class="">
                                   @forelse ($pizzas as $pizza)
                                   <tr class="tr-shadow row">
                                       <td class="col-2">
                                        @if ($pizza->image)
                                            <img width="100" height="100" src="{{ asset('storage/' . $pizza->image) }}" alt="">
                                        @else
                                            -
                                        @endif
                                       </td>
                                       <td class="col-2">
                                           <span class="block-email">{{$pizza->name}}</span>
                                       </td>
                                       <td class="col-2">
                                           <span class="block-email">{{$pizza->category->name}}</span>
                                       </td>
                                       <td class="col-1">
                                           <span class="block-email">{{$pizza->price}}</span>
                                       </td>
                                       <td class="col-1">
                                           <span class="block-email">{{$pizza->view_count}}</span>
                                       </td>
                                       <td class="col-2">{{$pizza->created_at->format('d-m-Y')}}</td>
                                       <td class="col-2">
                                           <div class="table-data-feature">
                                              <a href="{{ route('pizza.show', $pizza->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                              </a>
                                               <a href="{{ route('pizza.edit',$pizza->id) }}">
                                                   <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                       <i class="zmdi zmdi-edit"></i>
                                                   </button>
                                               </a>
                                               <form action="{{ route('pizza.delete',$pizza->id) }}" method="POST">@csrf
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
                           <div class="mt-2"> {{$pizzas->appends(request()->query())->links()}}</div>
                       </div>
                   <!-- END DATA TABLE -->
               </div>
           </div>
       </div>
   </div>
   <!-- END MAIN CONTENT-->

   
</x-admin-app-layout>
