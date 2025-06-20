@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Payroll</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Check</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-top-0">
                            <div class="card-header p-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab"
                                    role="tablist">
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profileTab" role="tab"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                                    <div class="card-body additional-info">
                                    <div class="card-body additional-info">
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="monthonly" class="fw-semibold">Date: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                    <input class="form-control" type="month" id="monthonly" name="date" placeholder="Month Of Payroll">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button id="check" class="btn btn-primary">Generate My Payroll</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="payroll-result"></div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('check');
        button.addEventListener('click', function () {
            const date = document.getElementById('monthonly').value;
            if (!date) return alert("Please select a month");

            button.disabled = true;
            button.textContent = 'Generating...';

            fetch("{{ route('payroll.check') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ date })
            })
            .then(res => res.json())
            .then(data => {
                button.disabled = false;
                button.textContent = 'Generate My Payroll';

                if (data.error) {
                    alert(data.error);
                    return;
                }

                document.getElementById('payroll-result').innerHTML = `
                    <div class="card mt-4">
                        <div class="card-header">
                            <strong>Generated Payroll</strong> ${data.date}
                        </div>
                        <div class="card-body">
                            <p><strong>Generated Salary:</strong> Present Days (${data.present_days}) × ${data.per_day_salary} = ${data.earned_salary} PKR</p>
                            <p><strong>Deduction:</strong> Absent Days (${data.absent_days}) × ${data.per_day_salary} = ${data.deduction} PKR</p>
                            <p><strong>Commission:</strong> ${data.commission} PKR</p>
                            <p><strong>Holidays:</strong> ${data.holiday_days} × ${data.per_day_salary} = ${data.holiday_pay} PKR</p>
                            <hr>
                            <p><strong>Total Payroll:</strong> ${data.total_pay.toLocaleString()} PKR</p>
                        </div>
                    </div>
                `;
            })
            .catch(err => {
                button.disabled = false;
                button.textContent = 'Generate My Payroll';
                console.error(err);
                alert("Something went wrong.");
            });
        });
    });
    </script>
@endsection