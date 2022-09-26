<x-admin-app-layout>

    <!-- MAIN CONTENT-->
    <div class="main-content">
       <div class="section__content section__content--p30">
           <div class="container-fluid">
                <div class="bg-white col-6 p-4">
                    <i class="fa-solid fa-1x fa-clipboard"></i> <h4 class="d-inline font-size-3">Order info</h4>
                    <div class="text-warning">
                        <i class="fa-sharp fa-solid fa-triangle-exclamation "></i><h6 class="text-small text-warning d-inline">Include delivery service chage</h6>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6"><i class="fas fa-user mr-3"></i>Name</div>
                        <div class="col-6">{{$orderlists[0]->user->name}}</div>
                        <div class="col-6 mt-2"><i class="fa-sharp fa-solid fa-barcode mr-3"></i>OrderCode</div>
                        <div class="col-6 mt-2">{{$orderlists[0]->order_code}}</div>
                        <div class="col-6 mt-2"><i class="fas fa-clock mr-3"></i>Order Date</div>
                        <div class="col-6 mt-2">{{$orderlists[0]->created_at->format('d/m/Y')}}</div>
                        <div class="col-6 mt-2"><i class="fa-sharp fa-solid fa-money-bill mr-3"></i>Total</div>
                        <div class="col-6 mt-2">{{$order->totalprice}}</div>
                    </div>
                </div>
               <div class="col-md-12">
                   <div class="table-responsive table-responsive-data2 ">
                       <table class="table table-data2 text-center mt-3">
                           <thead>
                               <tr class="row">
                                   <th class="col-2">User Name</th>
                                   <th class="col-2">Product Name</th>
                                   <th class="col-2">Product Photo</th>
                                   <th class="col-2">Qty</th>
                                   <th class="col-2">Amount </th>
                                   <th class="col-2">Order Date</th>
                               </tr>
                           </thead>
                           <tbody class="">
                                   @forelse ($orderlists as $orderlist)
                                   <tr class="tr-shadow row">

                                       <td class="col-2">
                                            <span>{{$orderlist->user->name}}</span>
                                       </td>
                                       <td class="col-2">
                                           <span>{{$orderlist->product->name}}</span>
                                        </td>
                                        <td class="col-2">
                                             <img width="50" height="50" class="img-thumbnail" src="{{ asset('storage/' . $orderlist->product->image) }}" alt="">
                                        </td>

                                       <td class="col-2">
                                           <span class="block-email" id="orderlistCode">{{$orderlist->qty}}</span>
                                       </td>
                                       <td class="col-2">
                                           <span class="block-email">{{$orderlist->total_price}}</span>
                                       </td>

                                       <td class="col-2">{{$orderlist->created_at->format('d/m/Y')}}</td>

                                   </tr>
                                   @empty
                                       <tr class="mt-5 bg-white text-black text-center block p-3 shadow-sm">
                                           <td>There is no category</td>
                                       </tr>
                                   @endforelse
                               </tbody>
                           </table>
                           {{-- <div class="mt-2"> {{$orderlists->links()}}</div> --}}
                       </div>
                   <!-- END DATA TABLE -->
               </div>
           </div>
       </div>
   </div>
   <!-- END MAIN CONTENT-->
   @push('scripts')

   @endpush
</x-admin-app-layout>
