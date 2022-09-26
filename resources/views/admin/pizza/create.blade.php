<x-admin-app-layout>
    <!-- MAIN CONTENT-->
    <div class="main-content">
     <div class="section__content section__content--p30">
         <div class="container-fluid">
             <div class="col-lg-6 offset-3">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title">
                             <h3 class="text-center title-2">Product Form</h3>
                         </div>
                         <hr>
                         <form action="{{ route('pizza.store') }}" method="POST" novalidate="novalidate" enctype="multipart/form-data">@csrf
                             <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                                 <input id="cc-pament" name="name" type="text" value="{{old('name')}}"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Name...">
                                 @error('name')
                                     <div class="invalid-feedback text-danger">{{$message}}</div>
                                 @enderror
                             </div>

                             <div class="form-group">
                                <label for="" class="control-label mb-1">Pizza Category</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="{{old('category_id')}}">{{ old('category_name') ?? 'Choose Category' }}</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                             </div>

                             <div class="form-group">
                                <label for="" class="control-label mb-1">Pizza Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror " placeholder="Description" id="" cols="5" rows="5" >{{old('description')}}</textarea>
                                @error('description')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Pizza Price</label>
                                <input id="cc-pament" name="price" type="text" value="{{old('price')}}"  class="form-control @error('price') is-invalid @enderror"  aria-invalid="false" placeholder="Price...">
                                @error('price')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1">Pizza Photo</label>
                                <input id="" name="image" type="file"   class="form-control @error('image') is-invalid @enderror"  aria-invalid="false" >
                                @error('image')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
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




