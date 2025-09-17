@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mb-3">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h1>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
                <form method="POST" action="{{ route('short-url') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">URL</label>
                        <input type="url" name="url" placeholder="ใส่ลิงก์ที่ต้องการย่อ" class="form-control mb-3" required>
                    </div>
                    <button class="btn btn-primary">
                        ย่อ URL
                    </button>
                </form>
            </div>

            @if(session('shortUrl'))
                <div class="col-lg-12">
                    Short URL:
                    <a href="{{ session('shortUrl') }}" target="_blank" class="">
                        {{ session('shortUrl') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
