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
                        <form action="{{ route('admin.save',$user->id) }}" method="POST"  enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($user->image)
                                    <a href="">
                                        <img src="{{ asset('storage/'. $user->image ) }}" alt="">
                                    </a>
                                    @else
                                    <a href="#">
                                        <img src="{{ asset('image/users/user_profile_default_img.png') }}" alt="">
                                    </a>
                                    @endif
                                    <div class="form-group mt-2">
                                        <input  name="image" type="file"   class="form-control  @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('image')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 offset-1">
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input  name="name" type="text" value="{{$user->name}}"  class="form-control  @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('name')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Email</label>
                                        <input  name="email" type="email" value="{{$user->email}}"  class="form-control  @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('email')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Phone</label>
                                        <input  name="phone" type="text" value="{{$user->phone}}"  class="form-control  @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('phone')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Address</label>
                                        <input  name="address" type="text" value="{{$user->address}}"  class="form-control  @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('address')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                             <div class="d-flex">
                                <button type="submit" class=" ml-auto btn btn-dark px-3 py-1 mt-1"> <i class="fas fa-save mr-2"></i>Save Profile</button>
                             </div>
                        </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
    </div>
 <!-- END MAIN CONTENT-->
</x-admin-app-layout>
