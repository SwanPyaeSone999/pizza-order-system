<x-admin-app-layout>
    <!-- MAIN CONTENT-->
    <div class="main-content">
     <div class="section__content section__content--p30">
         <div class="container-fluid">
             <div class="col-lg-6 offset-3">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title">
                             <h3 class="text-center title-2">Change Password</h3>
                         </div>
                         <hr>
                         <form action="{{ route('admin.changepassword') }}" method="POST" novalidate="novalidate">@csrf
                             <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                 <input id="cc-pament" name="old_password" type="password" value="{{old('old_password')}}"  class="form-control  @error('old_password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password">
                                 @error('old_password')
                                     <div class="invalid-feedback text-danger">{{$message}}</div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">New Password</label>
                                 <input id="cc-pament" name="new_password" type="password" value="{{old('new_password')}}"  class="form-control @error('new_password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                 @error('new_password')
                                     <div class="invalid-feedback text-danger">{{$message}}</div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                 <input id="cc-pament" name="confirm_password" type="password" value="{{old('confirm_password')}}"  class="form-control @error('confirm_password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                 @error('confirm_password')
                                     <div class="invalid-feedback text-danger">{{$message}}</div>
                                 @enderror
                             </div>



                             <div>
                                 <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                     <span id="payment-button-amount">Save</span>
                                     {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                     <i class="fa-solid fa-circle-right"></i>
                                 </button>
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




