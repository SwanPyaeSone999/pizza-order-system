<x-admin-app-layout>
    <!-- MAIN CONTENT-->
    <div class="main-content">
     <div class="section__content section__content--p30">
         <div class="container-fluid">
             <div class="col-lg-6 offset-3">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title">
                             <h3 class="text-center title-2">Change role</h3>
                         </div>
                         <hr>
                         <form action="{{ route('admin.changeRole', $account->id) }}" method="POST" novalidate="novalidate">@csrf
                             <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Name</label>
                                <select name="role" class="form-control" id="">
                                    <option value="admin" @selected($account->role == 'admin')>admin</option>
                                    <option value="user" @selected($account->role == 'user')>user</option>
                                </select>
                             </div>

                             <div>
                                 <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                     <span id="payment-button-amount">Create</span>
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




