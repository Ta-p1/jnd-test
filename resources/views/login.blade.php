@extends('app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email or Username</label>
                            <input type="text" name="login" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success">Login</button>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


