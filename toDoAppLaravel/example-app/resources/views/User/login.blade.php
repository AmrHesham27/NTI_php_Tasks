<x-header />
<x-navbar />
<body>
    <div class="page text-center">
    <h1>Login</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->get('mssg'))
        <div class="alert alert-primary my-5" role="alert">{{session()->get('mssg')}}</div>
    @endif

    <form action="<?php echo url('/loginAction');?>" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group my-4">
            <label>Email</label>
            <input class="form-control  mx-auto" placeholder="enter your email" name="email" value={{ old('email')}}>
        </div>
        <div class="form-group my-4">
            <label>Password</label>
            <input class="form-control  mx-auto" type="password" name="password" >
        </div>
        <button class="btn btn-primary">Login</button>
    </form>
    </div>
</body>
<x-footer/>
