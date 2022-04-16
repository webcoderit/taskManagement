@extends('backend.admin.admin-master')

@section('content')
    <div class="wrapper">
        <div class="page-wrapper" style="margin-left: 20px!important;">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Employee Tracking</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Employee Tracking</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h6 class="mb-0 text-uppercase">Employee Tracking list</h6>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>In time</th>
                                    <th>Out time</th>
                                    <th>Active Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            @if($user->status == 1)
                                            <td class="user-online-offline-b">
                                                <img src="{{ asset('/avatar/'.$user->avatar) }}" height="30" width="30" style="border-radius: 50%" />
                                                {{ $user->full_name ?? 'No name found' }}
                                            </td>
                                            @else
                                                <td class="user-online-offline-c">
                                                    <img src="{{ asset('/avatar/'.$user->avatar) }}" height="30" width="30" style="border-radius: 50%" />
                                                    {{ $user->full_name ?? 'No name found' }}
                                                </td>
                                            @endif
                                            <td>{{ $user->created_at->format('H:i A') }}</td>
                                            <td>{{ $user->updated_at->format('H:i A') }}</td>
                                            <td>
                                                @if($user->status == 1)
                                                    <span class="custom-green-badge">Active</span>
                                                @else
                                                    <span class="custom-red-badge">{{ $user->created_at->diffforhumans() }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        setInterval(function() {
            window.location.reload();
        }, 500000);
    </script>
@endpush
