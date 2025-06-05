@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Sale Invoice</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Invoice</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="{{route('sale.create')}}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Sale Invoice</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="paymentList">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                {{-- <th>Transaction</th> --}}
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr class="single-item">
                                                <td>
                                                    <a href="javascript:void(0)" class="hstack gap-3">
                                                        <div class="avatar-image avatar-md">
                                                            @php
                                                                $randomColor = 'ca0c2a'; // no '#' needed for UI Avatars API
                                                            @endphp
                                                            <img src="https://ui-avatars.com/api/?background={{ $randomColor }}&color=fff&name={{ urlencode($invoice->customer_name) }}"
                                                                class="img-fluid">
                                                        </div>
                                                        <div>
                                                            <span class="text-truncate-1-line">
                                                                {{ $invoice->customer_name ?? 'N/A' }}
                                                            </span>
                                                            <small class="fs-12 fw-normal text-muted">
                                                                {{ $invoice->customer_email ?? 'N/A' }}
                                                            </small>
                                                        </div>
                                                    </a>
                                                </td>

                                                <td class="fw-bold text-dark">
                                                    ${{ number_format($invoice->amount_due / 100, 2) }} USD
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::createFromTimestamp($invoice->created)->format('d/n/Y h:i A') }}
                                                </td>

                                                <td>
                                                    @if($invoice->status == 'paid')
                                                        <div class="badge bg-soft-success text-success">Paid</div>
                                                    @else
                                                        <div class="badge bg-soft-danger text-danger">{{ ucfirst($invoice->status) }}</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        @if($invoice->hosted_invoice_url)
                                                        <form action="{{ route('sale.send_invoice') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                                            <button type="submit"  class="btn btn-primary" {{ $invoice->status == 'paid' ? 'disabled' :'' }}>
                                                                <i class="feather feather-mail"></i> Send Invoice
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
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
            <!-- [ Main Content ] end -->

        </div>
        </div>
        <!-- [ Main Content ] end -->


        <script>
            function deleteInvoice(id) {
                if (confirm("Did you want to delete this Invoice?")) {
                    window.location.href = `/Invoice/delete/${id}`;
                }
            }
        </script>
        <script>
            $(document).on('change', '.Invoice-status-select', function () {
                const select = $(this);
                const status = select.val();
                const InvoiceId = select.data('id');

                $.ajax({
                    url: `/Invoice/update-status/${InvoiceId}`,
                    type: 'POST',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        toastr.success(response.message || 'Status updated successfully');
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong');
                    }
                });
            });
        </script>
@endsection