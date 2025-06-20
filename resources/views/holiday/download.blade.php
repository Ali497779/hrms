@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')


    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Ticket</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="loader"></div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
<script>
        window.onload = function () {
            // Trigger CSV download
            const a = document.createElement('a');
            a.href = "{{ $fileUrl }}";
            a.download = '';
            a.style.display = 'none';
            document.body.appendChild(a);
            a.click();

            // Toastr success message
            toastr.success("{{ $message }}");

            // Redirect after 3 seconds
            setTimeout(() => {
                window.location.href = "{{ $redirectUrl }}";
            }, 3000);
        };
    </script>
@endsection