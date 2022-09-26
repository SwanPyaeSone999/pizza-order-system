<x-user-layout>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Filter by Category</span>
                </h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="font-weight-bold" for="category ">Categories</span>
                            <span class="badge  font-weight-bold">({{\App\Models\Category::count()}})</span>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <a  class="text-dark" href="{{ route('user.home') }}"><span class="" for="category">All</span></a>
                        </div>
                        @foreach (\App\Models\Category::get() as $category)
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                              <a class="text-dark" href="{{ route('user.filter',$category->id) }}"><span class="" for="category">{{$category->name}}</span></a>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <!-- Shop Sidebar End -->
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class=" pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user.cartList') }}" class="btn btn-dark text-white position-relative rounded">
                                    <i class="fas fa-cart-shopping mr-2"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{count($cart) ?? 0}}
                                    </span>
                                </a>
                                <a href="{{ route('user.history') }}" class="ml-3  btn btn-dark text-white position-relative rounded">
                                    <i class="fas fa-clock-rotate-left mr-2"></i>History
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sort" class="form-control"  id="sortDate">
                                        <option value="desc">Descending</option>
                                        <option value="asc">Ascending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12" id="datalist">
                        @forelse ($pizzas as $pizza)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4 shadow-sm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 290px;" src="{{ asset('storage/'. $pizza->image ) }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user.show', $pizza->id ) }}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center bg-muted  py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{$pizza->name}}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5 class="">{{$pizza->price}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center w-full bg-white col-12 p-3 shadow-sm">There is no pizza <i class="fas fa-pizza-slice"></i></div>
                         @endforelse
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function(){
             $pizzalist =  $('#datalist');
            $('#sortDate').change(function(){
               $option = $('#sortDate').val();
            if($option == 'asc'){
                    $.ajax({
                        type : 'get',
                        url : '{{ route('ajax.pizza-list') }}',
                        data : {'status' : $option},
                        dataType : 'json',
                        success : function(response){
                            $list = '';
                            for($i=0; $i < response.length; $i++){
                                $list  += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                    <div class="product-item bg-light mb-4 shadow-sm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 290px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5 class="">${response[$i].price}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $pizzalist.html($list);
                        }
                    });
            }else if($option == 'desc'){
                $.ajax({
                    type : 'get',
                    url : '{{ route('ajax.pizza-list') }}',
                    data : {'status' : $option},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for($i=0; $i < response.length; $i++){
                            $list  += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4 shadow-sm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 290px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5 class="">${response[$i].price}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        $pizzalist.html($list);
                    }
                });
            }
            });
        });
    </script>
    @endpush
</x-user-layout>
