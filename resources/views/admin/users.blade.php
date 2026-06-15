@extends('admin.layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb mb-0 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </div>
    
    <!-- Users Card -->
    <div class="data-card">
        <div class="data-card-header">
            <h5 class="data-card-title">
                <i class="fas fa-users text-primary me-2"></i>All Users
            </h5>
            <div class="d-flex gap-2">
                <form class="input-group" style="width: 250px;" method="GET" action="{{ route('admin.users') }}">
                    <input type="text" class="form-control form-control-sm" placeholder="Search users..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="data-card-body">
            @if($users->isEmpty())
                <div class="data-card-empty">
                    <i class="fas fa-user-slash"></i>
                    <p>No users available at the moment.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="admin-table w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="table-id">#{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="seller-avatar me-2" style="width: 32px; height: 32px;">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4e73df&color=fff" alt="{{ $user->name }}" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile ?? 'N/A' }}</td>
                                    <td>
                                        @if($user->is_suspended)
                                            <span class="status-badge status-cancelled">
                                                <i class="fas fa-ban"></i> Suspended
                                            </span>
                                        @else
                                            <span class="status-badge status-completed">
                                                <i class="fas fa-check-circle"></i> Active
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <form action="{{ route('admin.users.toggle-suspend', $user->id) }}" method="POST" class="suspend-toggle-form">
                                                @csrf
                                                @if($user->is_suspended)
                                                    <button type="submit" class="btn btn-sm text-white" style="background-color: var(--success-color);" data-bs-toggle="tooltip" title="Unsuspend User">
                                                        <i class="fas fa-user-check"></i> Unsuspend
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-sm text-white" style="background-color: var(--danger-color);" data-bs-toggle="tooltip" title="Suspend User">
                                                        <i class="fas fa-user-slash"></i> Suspend
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if(method_exists($users, 'hasPages') && $users->hasPages())
                <div class="d-flex justify-content-end mt-4">
                    {{ $users->links() }}
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
