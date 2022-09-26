<x-admin-app-layout>
    <!-- MAIN CONTENT-->
    <div class="main-content">
     <div class="section__content section__content--p30">
         <div class="container-fluid">
             <div class="col-lg-10 offset-1">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title">
                             <h3 class="text-center title-2">Pizza Edit Form</h3>
                         </div>
                         <hr>
                        <form action="{{ route('pizza.update',$pizza->id) }}" method="POST"  enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($pizza->image)
                                    <div  class="w-full">
                                        <img class="w-full img-thumbnails" src="{{ asset('storage/'. $pizza->image ) }}" alt="">
                                    </div>
                                    @endif
                                    <div class="form-group mt-3">
                                        <input  name="image" type="file"   class="form-control  @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password">
                                        @error('image')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4 offset-1">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{ $pizza->name }}"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Name...">
                                        @error('name')
                                            <div class="invalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                       <label for="" class="control-label mb-1">Pizza Category</label>
                                       <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                                           <option value="{{old('category_id')}}">{{ old('category_name') ?? 'Choose Category' }}</option>
                                           @foreach ($categories as $category)
                                           <option value="{{$category->id}}"  @selected( $category->id == $pizza->category_id  )>{{$category->name}}</option>
                                           @endforeach
                                       </select>
                                       @error('category_id')
                                       <div class="invalid-feedback text-danger">{{$message}}</div>
                                       @enderror
                                    </div>

                                    <div class="form-group">
                                       <label for="" class="control-label mb-1">Pizza Description</label>
                                       <textarea name="description" class="form-control @error('description') is-invalid @enderror " placeholder="Description" id="" cols="5" rows="5" >{{$pizza->description}}</textarea>
                                       @error('description')
                                       <div class="invalid-feedback text-danger">{{$message}}</div>
                                       @enderror
                                   </div>

                                   <div class="form-group">
                                       <label for="cc-payment" class="control-label mb-1">Pizza Price</label>
                                       <input id="cc-pament" name="price" type="text" value="{{ $pizza->price }}"  class="form-control @error('price') is-invalid @enderror"  aria-invalid="false" placeholder="Price...">
                                       @error('price')
                                           <div class="invalid-feedback text-danger">{{$message}}</div>
                                       @enderror
                                   </div>


                                </div>
                             </div>
                             <div class="d-flex mt-3">
                                <button type="submit" class="text-white ml-auto btn btn-warning px-3 py-1 mt-1"> <i class="fas fa-edit mr-2"></i>Edit Pizza</button>
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
