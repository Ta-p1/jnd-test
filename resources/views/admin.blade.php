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

                <table class="table table-striped-columns" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Short URL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($links)
                            @foreach ($links as $key => $link)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $link->user->name }}</td>
                                    <td>
                                        <a href="{{ $link->short_url }}" target="_blank" class="">
                                            {{ $link->short_url }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="remove({{ $link->id }})">Remove</a>
                                       {{-- <form action="{{ route('remove', $link->id) }}" method="POST" onsubmit="return confirm('ต้องการลบลิงก์นี้ใช่ไหม?');">
                                            @csrf
                                            <button class="btn btn-danger">Remove</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            // $('#myTable').DataTable();
            $('#myTable').DataTable({
                ajax: {
                    url: "{{ route('show') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                },
                columns: [
                    {
                        data: 'id'
                    },
                    {
                        data: 'id',
                        "render": function(data, type, full) {
                            let name = full.user.name
                            return name;
                        }
                    },
                    {
                        data: 'short_url',
                        "render": function(data, type, full){
                            let html = `<a href="${data}" target="_blank" class="">${data}</a>`;
                            return html;
                        }
                    },
                    {
                        data: 'id',
                        "render": function(data, type, full) {
                            let html = `<a href="javascript:void(0);" onclick="remove(${data})">Remove</a>`;
                            return html;
                        }
                    },
                ]
            });
        });

        remove = (id) => {
            if (confirm("ต้องการลบลิงก์นี้ใช่ไหม?'") == true) {
                 $.ajax({
                    url: "{{ route('remove') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                    },
                    method: "POST",
                    success: function(res) {
                        if(res.status == "success"){
                            location.reload();
                        }
                        console.log(res);
                    }
                })
            }
        }
    </script>
@endsection
