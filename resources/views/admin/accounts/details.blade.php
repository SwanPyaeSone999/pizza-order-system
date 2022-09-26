<x-admin-app-layout>
    <!-- MAIN CONTENT-->
    <div class="main-content">
     <div class="section__content section__content--p30">
         <div class="container-fluid">
             <div class="col-lg-10 offset-1">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title">
                             <h3 class="text-center title-2">Account Info</h3>
                         </div>
                         <hr>
                         <div class="row">
                            <div class="col-3 offset-2">
                            @if ($user->image)
                                <a href="">
                                    <img src="{{ asset('storage/' . auth()->user()->image ) }}" alt="">
                                </a>
                            @else
                            <a href="#">
                                <img src="{{ asset('image/users/user_profile_default_img.png') }}" alt="">
                            </a>
                            @endif

                            </div>
                            <div class="col-5 offset-1">
                                <div class="font-weight-normal mt-3">Name - {{$user->name}}</div>
                                <div class="font-weight-normal mt-3">Email - {{$user->email}}</div>
                                <div class="font-weight-normal mt-3">Phone - {{$user->phone}}</div>
                                <div class="font-weight-normal mt-3">Address - {{$user->address}}</div>
                                <div class="font-weight-normal mt-3">Joined at - {{$user->created_at->format('j-F-Y')}}</div>
                            </div>
                         </div>
                         <div class="d-flex">
                            <a href="{{ route('admin.edit',$user->id) }}" class=" ml-auto btn btn-dark px-3 py-1 mt-1"> <i class="fas fa-edit  mr-2"></i> Edit Profile</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- END MAIN CONTENT-->
</x-admin-app-layout>
