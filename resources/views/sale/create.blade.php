@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <form action="{{ route('sale.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Project</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            {{-- {{ dd(date('d/m/Y')) }} --}}
            <div class="row">
                <div class="col-xl-12">
                    <div class="card invoice-container">
                        <div class="card-header">
                            <h5>Sale Invoice Create</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="px-4 pt-4">
                                <div class="d-md-flex align-items-center justify-content-between">
                                    <div class="mb-4 mb-md-0 your-brand">
                                        <div class="w-25 h-25 position-relative overflow-hidden border border-gray-2 rounded">
                                            <img src="{{asset('assets/images/logo.png')}}" class="upload-pic img-fluid rounded h-100 w-100" alt="">
                                            {{-- <div class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                                                <i class="feather feather-camera" aria-hidden="true"></i>
                                            </div> --}}
                                            {{-- <input class="file-upload" type="file" accept="image/*"> --}}
                                        </div>
                                        {{-- <div class="fs-12 text-muted mt-2">* Upload your brand</div> --}}
                                    </div>
                                    <div class="d-md-flex align-items-center justify-content-end gap-4">
                                        <div class="form-group mb-3 mb-md-0">
                                            <label class="form-label">Issue Date:</label>
                                            <input id="" class="form-control" name="issue_date" disabled value="{{ date('d/m/Y') }}" placeholder="Issue date...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-dashed">
                            <div class="row px-4 justify-content-between">
                                <div class="col-xl-5 mb-4 mb-sm-0">
                                    <div class="mb-4">
                                        <h6 class="fw-bold">Invoice From:</h6>
                                        <span class="fs-12 text-muted">Send an invoice and get paid</span>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="InvoiceName" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="createdbyname" id="InvoiceName" placeholder="Business Name" disabled value="{{ Auth::user()->name }}">
                                            <input type="hidden" name="createdby" value="{{ Auth::user()->id }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="mb-4">
                                        <h6 class="fw-bold">Invoice To:</h6>
                                        <span class="fs-12 text-muted">Send an invoice and get paid</span>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="ClientName" class="col-sm-3 col-form-label">Customer</label>
                                        <div class="col-sm-9">
                                            <select name="customer_id" class="form-select" id="">
                                                <option value="" selected disabled>Select Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" 
                                                        data-name="{{ $customer->user->name }}" 
                                                        data-email="{{ $customer->user->email }}"
                                                        >{{ $customer->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="ClientName" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input disabled type="text" name="customer_name" class="form-control" id="ClientName" placeholder="Business Name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="ClientEmail" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input disabled type="text" name="customer_email" class="form-control" id="ClientEmail" placeholder="Email Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-dashed">
                            <div class="px-4 clearfix">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="fw-bold">Add Items:</h6>
                                        <span class="fs-12 text-muted">Add items to invoice</span>
                                    </div>
                                    <div class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Informations">
                                        <i class="feather feather-info"></i>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered overflow-hidden" id="tab_logic">
                                        <thead>
                                            <tr class="single-item">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Product</th>
                                                {{-- <th class="text-center wd-150">Qty</th> --}}
                                                <th class="text-center wd-250">Price</th>
                                                {{-- <th class="text-center wd-150">Total</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="addr0">
                                                <td class="text-center">1</td>
                                                <td><input type="text" name="product[]" placeholder="Enter Product Name" class="form-control"></td>
                                                <td class="d-none"><input type="hidden" name="qty[]" placeholder="Enter Qty" class="form-control qty" value="1" step="1" min="1"></td>
                                                <td><input type="number" name="price[]" placeholder="Enter Unit Price" class="form-control price" step="1.00" min="1"></td>
                                                <td class="d-none"><input type="number" name="total[]" placeholder="0.00" class="form-control total" readonly=""></td>
                                            </tr>
                                            <tr id="addr1">
                                                <td class="text-center">2</td>
                                                <td></td>
                                                <td></td>
                                                {{-- <td></td> --}}
                                                {{-- <td></td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <button id="delete_row" class="btn btn-sm bg-soft-danger text-danger">Delete</button>
                                    <button type="button" id="add_row" class="btn btn-sm btn-primary">Add Items</button>
                                </div>
                            </div>
                            <hr class="border-dashed">
                            {{-- <div class="px-4 pb-4">
                                <div class="form-group">
                                    <label for="InvoiceNote" class="form-label">Invoice Description:</label>
                                    <textarea rows="6" class="form-control" id="InvoiceNote" name="invoice_description" placeholder="It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!"></textarea>
                                </div>
                            </div> --}}
                            <div class="row d-flex justify-content-end">
                                <div class="col-xl-4">
                                    <div class="card stretch stretch-full">
                                        <div class="card-body">
                                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h6 class="fw-bold">Grand Total:</h6>
                                                    <span class="fs-12 text-muted">Grand total invoice</span>
                                                </div>
                                                <div class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Grand total invoice">
                                                    <i class="feather feather-info"></i>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="tab_logic_total">
                                                    <tbody>
                                                        <tr class="single-item">
                                                            <th class="text-dark fw-semibold">Sub Total</th>
                                                            <td class="w-25"><input type="number" name="sub_total" placeholder="0.00" class="form-control border-0 bg-transparent p-0" id="sub_total" readonly=""></td>
                                                        </tr>
                                                        <tr class="single-item d-none">
                                                            <th class="text-dark fw-semibold">Tax</th>
                                                            <td class="w-25">
                                                                <div class="input-group mb-2 mb-sm-0">
                                                                    <input type="number" name="tax_percent" class="form-control border-0 bg-transparent p-0" id="tax" placeholder="0">
                                                                    <div class="input-group-addon">%</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="single-item d-none">
                                                            <th class="text-dark fw-semibold">Tax Amount</th>
                                                            <td class="w-50"><input type="number" name="tax_amount" id="tax_amount" placeholder="0.00" class="form-control d-none border-0 bg-transparent p-0" readonly=""></td>
                                                        </tr>
                                                        <tr class="single-item">
                                                            <th class="text-dark fw-semibold bg-gray-100">Grand Total</th>
                                                            <td class="bg-gray-100 w-50"><input type="number" name="total_amount" id="total_amount" placeholder="0.00" class="form-control border-0 bg-transparent p-0 fw-bolder text-dark" readonly=""></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row m-5">
                                            <button type="submit" class="btn btn-primary">Create Invoice</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </form>
    </main>

    <script src="{{ asset('assets/js/invoice-create-init.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $("#addr" + i)
                    .html($("#addr" + b).html())
                    .find("td:first-child")
                    .html(i + 1);
                $("#tab_logic").append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html("");
                    i--;
                }
                calc();
            });
            $("#tab_logic tbody").on("keyup change", function() {
                calc();
            });
            $("#tax").on("keyup change", function() {
                calc_total();
            });
        });

        function calc() {
            $("#tab_logic tbody tr").each(function(i, element) {
                var html = $(this).html();
                if (html != "") {
                    var qty = $(this).find(".qty").val();
                    var price = $(this).find(".price").val();
                    $(this)
                        .find(".total")
                        .val(qty * price);
                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $(".total").each(function() {
                total += parseInt($(this).val());
            });
            $("#sub_total").val(total.toFixed(2));
            tax_sum = (total / 100) * $("#tax").val();
            $("#tax_amount").val(tax_sum.toFixed(2));
            $("#total_amount").val((tax_sum + total).toFixed(2));
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const customerSelect = document.querySelector('select[name="customer_id"]');
        const nameInput = document.getElementById('ClientName');
        const emailInput = document.getElementById('ClientEmail');
        const phoneInput = document.getElementById('ClientPhone');

        customerSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];

            const name = selectedOption.getAttribute('data-name');
            const email = selectedOption.getAttribute('data-email');
            const phone = selectedOption.getAttribute('data-phone');

            nameInput.value = name || '';
            emailInput.value = email || '';
            phoneInput.value = phone || '';
        });
    });
</script>

@endsection