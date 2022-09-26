<x-user-layout>
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
           @if (count($cartList))
           <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                @forelse ($cartList as $cart)
                <tbody class="align-middle">
                    <tr id="cart">
                        <input type="hidden" value="{{$cart->product_id}}"  name=""  id="pizzaId">
                        <input type="hidden" value="{{$cart->user_id}}"  name=""  id="userId">
                        <input type="hidden" value="{{$cart->total_price}}"  name=""  id="total">
                        <td class="align-middle">{{$cart->pizza_name}}</td>
                        <td class="align-middle" id="price">{{$cart->pizza_price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 150px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input id="qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$cart->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus" >
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="item-total">{{$cart->total_price}}kyats</td>
                        <td class="align-middle">
                            <button class="btn btn-sm btn-danger removeCart"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    @empty
                        <tr class="mt-5 bg-white text-black text-center block p-3 shadow-sm">
                            <td>There is no items in the cart</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="sub-total">{{$cartList->sum('total_price')}}kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">2000</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 class="total">{{$cartList->sum('total_price') + 2000}}Kyats</h5>
                    </div>
                    <button  id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
           @else
                <div class="p-5 mt-5 bg-white text-dark col-12 text-center shadow-sm">
                    There is no items in the cart
                </div>
           @endif
        </div>
    </div>
    <!-- Cart End -->
    @push('scripts')
        <script>
            $(document).ready(function(){
                //add-btn
                $('.btn-plus').click(function(e){
                    $itemtotal =  $(this).closest('tr').find('#item-total');
                    $price = $(this).closest('tr').find('#price').text();
                    $pizzaId = $(this).closest("tr").find("#pizzaId").val();
                    $userId =  $(this).closest("tr").find("#userId").val();
                    $qty =  $(this).closest("tr").find("#qty").val();
                    $itemtotal.text($qty * $price + 'kyats');
                    summaryCalculation();
                     $data = {
                        'userId' : $userId,
                        'pizzaId' : $pizzaId,
                        'qty' : $qty,
                     }
                   cartAjax($data,'{{route('ajax.add')}}')
                });

                //minus btn
                $('.btn-minus').click(function(e){
                    $itemtotal =  $(this).closest('tr').find('#item-total');
                    $price = $(this).closest('tr').find('#price').text();
                    $pizzaId = $(this).closest("tr").find("#pizzaId").val();
                    $userId =  $(this).closest("tr").find("#userId").val();
                    $qty =  $(this).closest("tr").find("#qty").val();
                    $itemtotal.text($qty * $price + 'kyats');
                    if($qty == 0){
                        $(this).prop('disabled',true);
                    }
                    summaryCalculation();
                    $data = {
                        'userId' : $userId,
                        'pizzaId' : $pizzaId,
                        'qty' : $qty,
                    }
                    cartAjax($data,'{{route('ajax.minus')}}');

            });

            //remove cart
            $('.removeCart').click(function(){
                $itemRemove = $(this).closest("tr");
               $itemRemove.remove();
               summaryCalculation();
            });

            function summaryCalculation(){
                $totalprice = 0
                 $('table tbody tr').each(function(){
                     $totalprice +=  Number($(this).find('#item-total').text().replace('kyats',''));
                 });
                 $('#sub-total').text($totalprice + 'kyats');
                 if($totalprice == 0){
                    $('.total').text('0kyats');
                 }else{
                    $('.total').text(($totalprice + 2000) +'kyats');
                 }
            }

            function cartAjax($data ,$route){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type : 'post',
                    url :   $route,
                    data : $data,
                    dataType : 'json',
                });
            }

            //order ajax
            $('#orderBtn').click(function(){
                 $orderCode = Math.floor(1000 + Math.random() * 9000);

                $orderList = [];
                $('table tbody tr').each(function(){
                    $orderList.push({
                        'user_id' :  "{{auth()->user()->id}}",
                        'product_id' : $(this).find('#pizzaId').val(),
                        'qty' :  $(this).find('#qty').val(),
                        'total_price' : $(this).find('#total').val(),
                        'order_code' :  $orderCode,
                    })
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type : 'post',
                    url :  '{{route('ajax.order')}}',
                    data : Object.assign({},$orderList),
                    dataType : 'json',
                    success : function($response){
                        window.location.href = "http://localhost:8000/user/home";
                    }
                });
            })
            });
        </script>
    @endpush
</x-user-layout>
