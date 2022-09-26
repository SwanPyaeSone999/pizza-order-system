<x-guest-layout>
    <div class="login-form">
        <form  action="{{ route('login') }}" method="POST">@csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" value="{{old('password')}}" name="password" placeholder="Password">
                @error('password')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('register') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
</x-guest-layout>

