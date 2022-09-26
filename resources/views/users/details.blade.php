<x-user-layout>
      <!-- Shop Detail Start -->
      <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/'. $pizza->image) }}" alt="Image">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$pizza->name}}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1">{{$pizza->view_count}} <i class="fas fa-eye"></i></small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$pizza->price}}kyats</h3>
                    <p class="mb-4">{{$pizza->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <input type="text"  hidden value="{{auth()->user()->id}}" id="userId">
                        <input type="text"  hidden value="{{$pizza->id}}" id="pizzaId">
                        <div class="input-group quantity mr-3" style="width: 200px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control  bg-dark text-white border-0 text-center" value="1" id="cartCount">

                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button id="addToCart" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach (\App\Models\Product::get() as $item)
                    <div class="product-item bg-light" >
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100 " style="height: 280px;" src="{{ asset('storage/' . $item->image) }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{ route('user.show', $item->id ) }}"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$item->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$item->price}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
    @push('scripts')
        <script>
            $(document).ready(function(){
                //increase view count
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type : 'post',
                    url :  '{{route('ajax.viewCount')}}',
                    data : {
                        'product_id' : $('#pizzaId').val(),
                    },
                    dataType : 'json',
                })

                $('#addToCart').click(function(){
                    $userId = $('#userId').val();
                    $pizzaId = $('#pizzaId').val();
                    $count =  $('#cartCount').val() ;
                    $data = {
                        'count' : $count,
                        'userId' :  $userId,
                        'pizzaId' :  $pizzaId,
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type : 'post',
                        url :  '{{route('ajax.addToCart')}}',
                        data : $data,
                        dataType : 'json',
                        success : function($response){
                           if($response.status == '200'){
                                window.location.href = "http://localhost:8000/user/home";
                           }
                        }
                    })
                })
            })
        </script>
    @endpush
</x-user-layout>










