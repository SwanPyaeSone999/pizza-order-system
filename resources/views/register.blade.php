<x-guest-layout>
    <div class="login-form">
        <form method="POST" action="{{ route('register') }}">@csrf

            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username" value="{{old('name')}}">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="text" name="phone" value="{{old('phone')}}" placeholder="Phone">
                @error('phone')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" value="{{old('address')}}" placeholder="Address">
                @error('address')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" value="{{old('password')}}" placeholder="Password">
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"  placeholder="Confirm Password">
                @error('password_confirmation')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('login') }}">Sign In</a>
            </p>
        </div>
    </div>
</x-guest-layout>

