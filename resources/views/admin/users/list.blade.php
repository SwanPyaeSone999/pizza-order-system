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
                               <h2 class="title-1">User List</h2>
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

                   <form action="{{ route('admin.user.list') }}" method="GET" class="mb-3">
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
                                   <th class="col-1">Photo</th>
                                   <th class="col-1">Name</th>
                                   <th class="col-2">Email</th>
                                   <th class="col-2">Phone</th>
                                   <th class="col-1">Address</th>
                                   <th class="col-1">Created Date</th>
                                   <th class="col-2">Role</th>
                                   <td class="col-1"></td>
                               </tr>
                           </thead>
                           <tbody>
                                   @forelse ($users as $user)
                                   <tr class="tr-shadow row">
                                       <td class="col-1">
                                           @if ($user->image)
                                           <img width="100" height="100"    src="{{ asset('storage/' . $user->image) }}" alt="">
                                           @else
                                           <img width="100" height="100" src="{{ asset('image/users/user_profile_default_img.png') }}" alt="">
                                            @endif
                                        </td>
                                        <td class="col-1">
                                            <span class="">{{$user->name}}</span>
                                        </td>
                                        <td class="col-2">
                                            <span class="">{{$user->email}}</span>
                                        </td>
                                        <td class="col-2">
                                           <span class="">{{$user->phone}}</span>
                                        </td>
                                        <td class="col-1">
                                           <span class="">{{ Str::limit($user->address, 15, ' ...')}}</span>
                                       </td>
                                       <td class="col-1">{{$user->created_at->format('d/m/Y')}}</td>
                                       <td><input type="text"  hidden value="{{$user->id}}" id="user_id"></td>
                                       <td class="col-2">
                                           <select name="role" class="form-control changeRole" id="">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                       </td>
                                       <td class="col-1">
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin.user.edit',$user->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('admin.user.delete',$user->id) }}" method="POST">@csrf
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
                                           <td>There is no user</td>
                                       </tr>
                                   @endforelse
                               </tbody>
                           </table>
                           <div class="mt-2"> {{$users->links()}}</div>
                       </div>
                   <!-- END DATA TABLE -->
               </div>
           </div>
       </div>
   </div>
   <!-- END MAIN CONTENT-->
   @push('scripts')
       <script>
        $(document).ready(function(){
            $('table tbody tr').find('.changeRole').change(function(){
               $data = {
                'role' :  $(this).closest('tr').find('.changeRole').val(),
                'id'  : $(this).closest('tr').find('#user_id').val(),
               }
               $.ajax({
                    type : 'get',
                    url :  '{{route('admin.user.changeRole')}}',
                    data : $data,
                    dataType : 'json',
                    success : function($response){
                        location.reload();
                    }
                });
            });
        });
       </script>
   @endpush
</x-admin-app-layout>
