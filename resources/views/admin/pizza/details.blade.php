<x-admin-app-layout>
    <!-- MAIN CONTENT-->
    <div class="main-content">
     <div class="section__content section__content--p30">
         <div class="container-fluid">
             <div class="col-lg-10 offset-1">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title">
                             <h3 class="text-center title-2">Pizza Info</h3>
                         </div>
                         <hr>
                         <div class="row">
                            <div class="col-5">
                            @if ($pizza->image)
                                <a href="">
                                    <img src="{{ asset('storage/' . $pizza->image ) }}" alt="">
                                </a>
                            @endif
                            </div>
                            <div class="col-5 ">
                                <div class="font-weight-normal mt-3 mb-4 font-weight-bold font-size-1"><h3> {{$pizza->name}}</h3></div>
                                <span class="font-weight-normal mt-3 bg-dark mr-1 p-2 text-white"> {{$pizza->category->name}}</span>
                                <span class="font-weight-normal mt-3 bg-dark mr-1 p-2 text-white"> {{$pizza->price}}</span>
                                <span class="font-weight-normal mt-3 bg-dark mr-1 p-2 text-white"> {{$pizza->view_count}}</span>
                                <span class="font-weight-normal mt-3 bg-dark mr-1 p-2 text-white"> {{$pizza->created_at->format('d-m-Y')}}</span>
                                <div class="mt-4">
                                    <h4><i class="fas fa-list mr-2"></i>Details</h4>
                                </div>
                                <p class="mt-3">
                                    {{$pizza->description}}
                                </p>
                            </div>
                         </div>
                         <div class="d-flex mt-3">
                            <a href="{{ route('pizza.edit',$pizza->id) }}" class=" text-white ml-auto btn btn-warning px-3 py-1 mt-1"> <i class="fas fa-edit  mr-2"></i> Edit Pizza</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- END MAIN CONTENT-->
</x-admin-app-layout>

