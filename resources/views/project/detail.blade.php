@extends('layouts.dashboard')

@section('title', 'Project Detail')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Project Detail</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('project.list') }}">Projects</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="overviewTab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-body task-header d-md-flex align-items-center justify-content-between">
                                        <div class="me-4">
                                            <h4 class="mb-4 fw-bold d-flex">
                                                <span class="text-truncate-1-line">{{ $project->title }} 
                                                    <?php
                                                    if($project->status == 'pending'){
                                                        $status_class = 'bg-soft-warning text-warning';
                                                    }elseif($project->status == 'progress'){
                                                        $status_class = 'bg-soft-warning text-warning';
                                                    }elseif($project->status == 'completed'){
                                                        $status_class = 'bg-soft-success text-success';
                                                    }elseif($project->status == 'incompleted'){
                                                        $status_class = 'bg-soft-danger text-danger';
                                                    }elseif($project->status == 'closed'){
                                                        $status_class = 'bg-soft-danger text-danger';
                                                    }
                                                    ?>
                                                    <span class="badge {{ $status_class }} mx-3">{{ $project->status }} </span>
                                            
                                                </span>
                                            </h4>
                                            <div class="d-flex align-items-center">
                                                {{-- <span class="vr mx-3 text-muted"></span> --}}
                                                <div class="img-group lh-0 ms-2 justify-content-start">
                                                    @foreach ($project->members as $member)
                                                            @php
                                                                $randomColor = substr(md5($member->employee->user->name), 0, 6); // deterministic based on name, optional
                                                            @endphp

                                                            <img class="avatar-image avatar-md" src="https://ui-avatars.com/api/?background={{ $randomColor }}&color=fff&name={{ urlencode($member->employee->user->name) }}"
                                                                alt="Avatar" width="100" title="{{ $member->employee->user->name }} ({{ $member->employee->designation }})">
                                                    @endforeach
                                                    <span class="d-none d-sm-flex">
                                                        <span class="fs-12 text-muted ms-3 text-truncate-1-line">{{ count($project->members) }} members</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mt-md-0">
                                            <div class="d-flex gap-2">
                                                <a href="javascript:void(0);" class="btn btn-icon" data-bs-toggle="tooltip" title="Make as Complete">
                                                    <i class="feather-check-circle"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon" data-bs-toggle="tooltip" title="Timesheets">
                                                    <i class="feather-calendar"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon" data-bs-toggle="tooltip" title="Statistics">
                                                    <i class="feather-bar-chart-2"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-success" data-bs-toggle="tooltip" title="Timesheets">
                                                    <i class="feather-clock me-2"></i>
                                                    <span>Start Timer</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h3>Details</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Project</label>
                                                <p>#0{{ $project->id }} - {{ $project->title }}</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Status</label>
                                                <p>{{ $project->status }}</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Customer</label>
                                                <p>{{ $project->customer->name }}</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Start Date </label>
                                                <p>{{ $project->start_date  ?? 'N/A'}}</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">End Date </label>
                                                <p>{{ $project->end_date  ?? 'N/A'}}</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Logged Hours </label>
                                                <p>00:00</p>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Description</label>
                                                <p>{{$project->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           @php
                                $attachments = json_decode($project->attachments, true);
                                $storagePath = asset('/');
                                $svgBoxBase = 'https://s2.svgbox.net/files.svg?ic=';

                                // Map extensions to icon names from SVGBox
                                $fileIcons = [
                                    'pdf' => 'pdf',
                                    'php' => 'php',
                                    'pub' => 'publisher',
                                    'doc' => 'word',
                                    'docx' => 'word',
                                    'xls' => 'excel',
                                    'xlsx' => 'excel',
                                    'sql' => 'sql',
                                    'zip' => 'zip',
                                    'rar' => 'zip',
                                    'psd' => 'psd',
                                    'ai' => 'ai',
                                    'indd' => 'indesign',
                                    'mp3' => 'music',
                                    'wav' => 'music',
                                    'ogg' => 'music',
                                    'mp4' => 'video',
                                    'webm' => 'video',
                                    'mov' => 'video',
                                    'txt' => 'text',
                                    'csv' => 'excel',
                                    'json' => 'json',
                                    'default' => 'file',
                                ];
                            @endphp

                            <div class="col-xl-4">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h3>Attachments</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($attachments as $file)
                                                @php
                                                    $filePath = $storagePath . $file['path'];
                                                    $fileName = $file['name'];
                                                    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                                                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                    $isAudio = in_array($ext, ['mp3', 'wav', 'ogg']);
                                                    $isVideo = in_array($ext, ['mp4', 'webm', 'mov']);

                                                    $iconKey = $fileIcons[$ext] ?? $fileIcons['default'];
                                                    $iconUrl = $svgBoxBase . $iconKey;
                                                @endphp

                                                <div class="col-md-6 col-lg-4 mb-3 text-center">
                                                    @if ($isImage)
                                                        <a href="{{ $filePath }}" target="_blank">
                                                            <img src="{{ $filePath }}" alt="{{ $fileName }}" class="img-fluid rounded shadow" style="max-height: 150px;">
                                                            <div class="mt-2 text-truncate">{{ $fileName }}</div>
                                                        </a>
                                                    @elseif ($isAudio)
                                                        <audio controls class="w-100">
                                                            <source src="{{ $filePath }}" type="audio/{{ $ext }}">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                        <div class="mt-2 text-truncate">{{ $fileName }}</div>
                                                    @elseif ($isVideo)
                                                        <video controls class="w-100" style="max-height: 150px;">
                                                            <source src="{{ $filePath }}" type="video/{{ $ext }}">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <div class="mt-2 text-truncate">{{ $fileName }}</div>
                                                    @else
                                                        <a href="{{ $filePath }}" target="_blank" class="text-decoration-none">
                                                            <img src="{{ $iconUrl }}" alt="{{ $ext }}" style="height: 64px;" class="mb-2">
                                                            <div class="text-truncate" style="max-width: 100%;">{{ $fileName }}</div>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Add Acchament
                                                    </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                          <fieldset class="upload_dropZone text-center mb-3 p-4">
                                                            <svg class="upload_svg" width="60" height="60" aria-hidden="true">
                                                            <use href="#icon-imageUpload"></use>
                                                            </svg>
                                                            <p class="small my-2">Drag &amp; Drop logo image(s) inside dashed region<br><i>or</i></p>

                                                            <input id="upload_image_logo" data-post-name="image_logo" data-post-url="https://someplace.com/image/uploads/logos/" class="position-absolute invisible" type="file" multiple accept="image/jpeg, image/png, image/svg+xml" />

                                                            <label class="btn btn-upload mb-3" for="upload_image_logo">Choose file(s)</label>

                                                            <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>

                                                        </fieldset>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="tab-pane fade" id="activityTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No activity yet!</h2>
                                        <p class="fs-12 text-muted">There is no activity on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Activity">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="timesheetsTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No timesheets yet!</h2>
                                        <p class="fs-12 text-muted">There is no timesheets on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Timesheets">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="milestonesTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No milestones yet!</h2>
                                        <p class="fs-12 text-muted">There is no milestones on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Milestones">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discussionsTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No discussions yet!</h2>
                                        <p class="fs-12 text-muted">There is no discussions on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Discussions">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </main>

    <script>
        (function () {

            'use strict';
            
            // Four objects of interest: drop zones, input elements, gallery elements, and the files.
            // dataRefs = {files: [image files], input: element ref, gallery: element ref}

            const preventDefaults = event => {
                event.preventDefault();
                event.stopPropagation();
            };

            const highlight = event =>
                event.target.classList.add('highlight');
            
            const unhighlight = event =>
                event.target.classList.remove('highlight');

            const getInputAndGalleryRefs = element => {
                const zone = element.closest('.upload_dropZone') || false;
                const gallery = zone.querySelector('.upload_gallery') || false;
                const input = zone.querySelector('input[type="file"]') || false;
                return {input: input, gallery: gallery};
            }

            const handleDrop = event => {
                const dataRefs = getInputAndGalleryRefs(event.target);
                dataRefs.files = event.dataTransfer.files;
                handleFiles(dataRefs);
            }


            const eventHandlers = zone => {

                const dataRefs = getInputAndGalleryRefs(zone);

                if (!dataRefs.input) return;

                // Prevent default drag behaviors
                ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
                zone.addEventListener(event, preventDefaults, false);
                document.body.addEventListener(event, preventDefaults, false);
                });

                // Highlighting drop area when item is dragged over it
                ;['dragenter', 'dragover'].forEach(event => {
                zone.addEventListener(event, highlight, false);
                });
                ;['dragleave', 'drop'].forEach(event => {
                zone.addEventListener(event, unhighlight, false);
                });

                // Handle dropped files
                zone.addEventListener('drop', handleDrop, false);

                // Handle browse selected files
                dataRefs.input.addEventListener('change', event => {
                dataRefs.files = event.target.files;
                handleFiles(dataRefs);
                }, false);

            }


            // Initialise ALL dropzones
            const dropZones = document.querySelectorAll('.upload_dropZone');
            for (const zone of dropZones) {
                eventHandlers(zone);
            }


            // No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
            // Double checks the input "accept" attribute
            const isImageFile = file => 
                ['image/jpeg', 'image/png', 'image/svg+xml'].includes(file.type);


            function previewFiles(dataRefs) {
                if (!dataRefs.gallery) return;
                for (const file of dataRefs.files) {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function() {
                    let img = document.createElement('img');
                    img.className = 'upload_img mt-2';
                    img.setAttribute('alt', file.name);
                    img.src = reader.result;
                    dataRefs.gallery.appendChild(img);
                }
                }
            }

            // Based on: https://flaviocopes.com/how-to-upload-files-fetch/
            const imageUpload = dataRefs => {

                // Multiple source routes, so double check validity
                if (!dataRefs.files || !dataRefs.input) return;

                const url = dataRefs.input.getAttribute('data-post-url');
                if (!url) return;

                const name = dataRefs.input.getAttribute('data-post-name');
                if (!name) return;

                const formData = new FormData();
                formData.append(name, dataRefs.files);

                fetch(url, {
                method: 'POST',
                body: formData
                })
                .then(response => response.json())
                .then(data => {
                console.log('posted: ', data);
                if (data.success === true) {
                    previewFiles(dataRefs);
                } else {
                    console.log('URL: ', url, '  name: ', name)
                }
                })
                .catch(error => {
                console.error('errored: ', error);
                });
            }


            // Handle both selected and dropped files
            const handleFiles = dataRefs => {

                let files = [...dataRefs.files];

                // Remove unaccepted file types
                files = files.filter(item => {
                if (!isImageFile(item)) {
                    console.log('Not an image, ', item.type);
                }
                return isImageFile(item) ? item : null;
                });

                if (!files.length) return;
                dataRefs.files = files;

                previewFiles(dataRefs);
                imageUpload(dataRefs);
            }

            })();
    </script>

@endsection
