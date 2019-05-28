@extends("layouts/app")

@section("content")
    <div class="title m-b-md">
        Please give us your information
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <form action="/process" method="POST">
        @csrf

        <div class="form-control">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" />
        </div>
        <div class="form-control">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" />
        </div>
        <div class="form-control">
            <label for="emailAddress">Primary Email Address</label>
            <input type="email" name="emailAddress" />
        </div>
        <div class="form-control">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" name="phoneNumber" />
        </div>

        <div class="form-control">
            <button>Sign Up</button>
        </div>
    </form>
@endsection
