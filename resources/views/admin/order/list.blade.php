<x-admin-app-layout>
    <!-- MAIN CONTENT-->
    <div class="main-content">
       <div class="section__content section__content--p30">
           <div class="container-fluid">
               <div class="col-md-12">
                   <!-- DATA TABLE -->
                   <div class="table-data__tool">
                       <div class="table-data__tool-left">
                           <div class="overview-wrap">
                               <h2 class="title-1">Order List</h2>
                           </div>
                       </div>
                   </div>
                   <form action="{{ route('order.list') }}" method="GET" class="mb-3" >
                        <span>Status</span>
                        <select name="status" id=""   class="form-control col-3 inline-block" onchange="this.form.submit()">
                            <option value="all">All</option>
                            <option value="Pending" @selected(request('status') == 'Pending')>Pending</option>
                            <option value="Success" @selected(request('status') == 'Success')>Success</option>
                            <option value="Cancel" @selected(request('status') == 'Cancel')>Cancel</option>
                        </select>
                   </form>
                   <div class="table-responsive table-responsive-data2 ">
                       <table class="table table-data2 text-center mt-3">
                           <thead>
                               <tr class="row">
                                   <th class="col-2">User Name</th>
                                   <th class="col-2">Order Code</th>
                                   <th class="col-2">Amount </th>
                                   <th class="col-3">Status</th>
                                   <th class="col-2">Order Date</th>
                               </tr>
                           </thead>
                           <tbody class="">
                                   @forelse ($orders as $order)
                                   <tr class="tr-shadow row">

                                       <td class="col-2">
                                            <span>{{$order->user->name}}</span>
                                       </td>
                                       <td class="col-2">
                                           <a href="{{ route('order.details', ['ordercode'=> $order->order_code]) }}"><span class="block-email text-primary
                                            " id="orderCode">{{$order->order_code}}</span></a>
                                       </td>
                                       <td class="col-2">
                                           <span class="block-email">{{$order->totalprice}}</span>
                                       </td>
                                       <td class="col-3">
                                          <select name="status" id="status" class="form-control">
                                              <option value="Success" @selected($order->status === 'Success')>Success</option>
                                            <option value="Pending" @selected($order->status === 'Pending')>Pending</option>
                                            <option value="Cancel" @selected($order->status === 'Cancel')>Cancel</option>
                                          </select>
                                       </td>

                                       <td class="col-2">{{$order->created_at->format('d-m-Y')}}</td>

                                   </tr>
                                   @empty
                                       <tr class="mt-5 bg-white text-black text-center block p-3 shadow-sm">
                                           <td>There is no category</td>
                                       </tr>
                                   @endforelse
                               </tbody>
                           </table>
                           <div class="mt-2"> {{$orders->appends(request()->query())->links()}}</div>
                       </div>
                   <!-- END DATA TABLE -->
               </div>
           </div>
       </div>
   </div>
   <!-- END MAIN CONTENT-->
   @push('scripts')
       <script>
            $(document).ready(function(){
                $('table tbody tr').find('#status').change(function(){
                   $data = {
                    'status' :  $(this).closest('tr').find('#status').val(),
                    'order_code' : $(this).closest('tr').find('#orderCode').text(),
                   }
                   $.ajax({
                        type : 'get',
                        url :  '{{route('order.status')}}',
                        data : $data,
                        dataType : 'json',
                        success : function($response){
                            location.reload();
                        }
                    });
                });

            });
       </script>
   @endpush
</x-admin-app-layout>
