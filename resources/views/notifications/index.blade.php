@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All Notifications</h5>
                    <a href="javascript:void(0);" class="btn btn-sm btn-success mark-all-read">
                        <i class="feather-check"></i> Mark All as Read
                    </a>
                </div>

                <div class="card-body">
                    @forelse($notifications as $notification)
                        <div class="notifications-item mb-3 p-3 border rounded">
                            <div class="notifications-desc">
                                <a href="javascript:void(0);" class="font-body">
                                    {{ $notification->data['message'] }}
                                </a>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="notifications-date text-muted">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($notification->unread())
                                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-success mark-as-read"
                                                data-id="{{ $notification->id }}">
                                                <i class="feather-check"></i> Mark as Read
                                            </a>
                                        @endif
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-notification"
                                            data-id="{{ $notification->id }}">
                                            <i class="feather-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">No notifications found.</div>
                    @endforelse

                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Same JavaScript as in the layout for handling actions
    });
</script>
@endsection