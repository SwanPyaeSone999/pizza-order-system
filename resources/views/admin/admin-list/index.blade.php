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
                               <h2 class="title-1">Admin List</h2>
                           </div>
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

                   <form action="{{ route('admin.list') }}" method="GET" class="mb-3">
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
                                   <th class="col-1">Name</th>
                                   <th class="col-2">Email</th>
                                   <th class="col-2">Phone</th>
                                   <th class="col-3">Address</th>
                                   <th class="col-1">Created Date</th>
                               </tr>
                           </thead>
                           <tbody>
                                   @forelse ($admins as $admin)
                                   <tr class="tr-shadow row">
                                        <td class="col-2">
                                            @if ($admin->image)
                                                <img width="100" height="100"    src="{{ asset('storage/' . $admin->image) }}" alt="">
                                            @else
                                                <img width="100" height="100" src="{{ asset('image/users/user_profile_default_img.png') }}" alt="">
                                            @endif
                                        </td>
                                       <td class="col-1">
                                           <span class="">{{$admin->name}}</span>
                                       </td>
                                       <td class="col-2">
                                           <span class="">{{$admin->email}}</span>
                                       </td>
                                       <td class="col-2">
                                           <span class="">{{$admin->phone}}</span>
                                       </td>
                                       <td class="col-3">
                                           <span class="">{{$admin->address}}</span>
                                       </td>
                                       <td class="col-1">{{$admin->created_at->format('d-m-Y')}}</td>
                                       @if (auth()->user()->id != $admin->id)
                                       <td class="col-1">
                                            <a href="{{ route('admin.role', $admin->id) }}">
                                                <i class="fas fa-edit text-warning"></i>
                                            </a>
                                            <form action="{{ route('admin.delete', $admin->id)  }}" method="POST">@csrf
                                            @method('DELETE')
                                                <button type="submit" class=""><i class="fas fa-trash text-dark"></i></button>
                                            </form>
                                        </td>
                                        @endif
                                   </tr>
                                   @empty
                                       <tr class="mt-5 bg-white text-black text-center block p-3 shadow-sm">
                                           <td>There is no admin</td>
                                       </tr>
                                   @endforelse
                               </tbody>
                           </table>
                           <div class="mt-2"> {{$admins->links()}}</div>
                       </div>
                   <!-- END DATA TABLE -->
               </div>
           </div>
       </div>
   </div>
   <!-- END MAIN CONTENT-->

</x-admin-app-layout>
