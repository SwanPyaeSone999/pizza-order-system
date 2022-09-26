<x-user-layout>
        <div class="container">
            <div class="col-12 bg-white shadow-sm p-5">
                @if (session('sent'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{session('sent')}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <h3 class="text-center">Contact Us</h3>
                <form action="{{ route('user.storeContact') }}" method="POST">@csrf
                    <div class="form-group mb-3 mt-4">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="" name="name"  value="{{old('name')}}">
                        @error('name')
                            <span class="mt-1 text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-4">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="" name="email" value="{{old('email')}}">
                        @error('email')
                        <span class="mt-1 text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-4">
                        <textarea  id="" class="form-control" cols="5"  name="message" rows="5" placeholder="Say Something..."></textarea>
                        @error('message')
                        <span class="mt-1 text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="px-3 py-1 bg-warning text-white btn">Send</button>
                </form>
            </div>
        </div>
</x-user-layout>
