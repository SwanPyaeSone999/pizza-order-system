<x-user-layout>
    <div class="row ">
        <div class="col-md-6 offset-3">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="">
                            <div class="card rounded-sm shadow-sm">
                                <div class="card-body">
                                    @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span>{{session('success')}}</span>
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                    @endif
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('user.password-update') }}" method="POST" novalidate="novalidate">@csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                            <input name="old_password" type="password" value="{{old('old_password')}}"  class="form-control  @error('old_password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password">
                                            @error('old_password')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                                            <input name="new_password" type="password" value="{{old('new_password')}}"  class="form-control @error('new_password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                            @error('new_password')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                            <input name="confirm_password" type="password" value="{{old('confirm_password')}}"  class="form-control @error('confirm_password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                            @error('confirm_password')
                                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="" type="submit" class="btn btn-lg btn-dark btn-block text-white">
                                                <i class="fa-solid fa-key me-2"></i>
                                                <span id="payment-button-amount">Change</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
        </div>
    </div>
</x-user-layout>
