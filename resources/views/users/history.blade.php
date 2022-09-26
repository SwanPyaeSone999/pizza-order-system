<x-user-layout>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    @foreach ($orders as $order)
                    <tbody>
                        <tr>
                            <th>{{$order->created_at->format('d/m/Y')}}</th>
                            <th>{{$order->order_code}}</th>
                            <th>{{$order->totalprice}}</th>
                            <th class="
                            @if ($order->status == 'Success')
                                text-success
                            @elseif($order->status == 'Pending')
                                text-warning
                            @else
                                text-danger
                            @endif
                            ">{{$order->status}}</th>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="mt-1">
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
