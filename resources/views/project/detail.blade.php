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
                                            <input type="hidden" name="project_id" class="project_id" value="{{ $project->id }}">
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
                                            @if($attachments != null)
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
                                            @endif
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
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="overviewTab">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3>Discussion</h3>
                                        @if ($hasMore)
                                            <button class="btn btn-primary" id="loadMoreMessages" data-offset="50">Load Previous Messages</button>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <!-- Chat Area -->
                                        @if ($hasMore)
                                            <button id="loadMoreMessages" data-offset="50">Load Previous Messages</button>
                                        @endif
                                        <div class="chat-box mb-3" id="chat-box" style="max-height: 400px; overflow-y: auto;">
                                            <!-- Chat messages will be injected here -->
                                        </div>

                                        <!-- Input Box -->
                                        <!-- Chat Input Area -->
                                        <div class="d-flex align-items-center gap-2 mt-3">
                                            <div id="message-input" class="form-control" contenteditable="true" style="min-height: 80px;"></div>
                                            <button class="btn btn-primary" id="send-message">Send</button>

                                            <!-- GIF Button -->
                                            <button class="btn btn-outline-secondary" id="gif-btn">GIF</button>

                                            <!-- GIF Modal -->
                                            <div id="gif-modal" class="d-none border p-2 bg-light position-absolute" style="bottom: 60px; right: 120px; width: 300px; z-index: 999;">
                                                <input type="text" id="gif-search" class="form-control mb-2" placeholder="Search GIFs">
                                                <div id="gif-results" style="max-height: 200px; overflow-y: auto;"></div>
                                            </div>

                                            <!-- Emoji Button -->
                                            <button id="emoji-btn" type="button" class="btn btn-outline-secondary">😊</button>
                                            <div class="position-relative">
                                                <emoji-picker id="emoji-picker" class="d-none"></emoji-picker>
                                            </div>

                                            <!-- File Upload -->
                                            <input type="file" id="chat-file" class="d-none">
                                            <label for="chat-file" class="btn btn-outline-secondary mb-0">📎</label>
                                        </div>

                                        <!-- File Name Preview -->
                                        <div class="mt-2">
                                            <span id="selected-file-name" class="text-muted small"></span>
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
    </main>

    {{-- Drag & Drop File Upload Logic --}}
    <script>
    (function () {
        'use strict';

        // Prevent default browser behavior for drag/drop
        const preventDefaults = event => {
            event.preventDefault();
            event.stopPropagation();
        };

        // Highlight drop area on dragover
        const highlight = event => event.target.classList.add('highlight');

        // Remove highlight when drag leaves
        const unhighlight = event => event.target.classList.remove('highlight');

        // Get references to input and preview gallery inside a drop zone
        const getInputAndGalleryRefs = element => {
            const zone = element.closest('.upload_dropZone') || false;
            const gallery = zone.querySelector('.upload_gallery') || false;
            const input = zone.querySelector('input[type="file"]') || false;
            return { input, gallery };
        };

        // Handle file drop into zone
        const handleDrop = event => {
            const dataRefs = getInputAndGalleryRefs(event.target);
            dataRefs.files = event.dataTransfer.files;
            handleFiles(dataRefs);
        };

        // Add event listeners for drop zones
        const eventHandlers = zone => {
            const dataRefs = getInputAndGalleryRefs(zone);
            if (!dataRefs.input) return;

            // Setup drag event listeners
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
                zone.addEventListener(event, preventDefaults, false);
                document.body.addEventListener(event, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(event => {
                zone.addEventListener(event, highlight, false);
            });
            ['dragleave', 'drop'].forEach(event => {
                zone.addEventListener(event, unhighlight, false);
            });

            // Drop file handler
            zone.addEventListener('drop', handleDrop, false);

            // Change event for file input (browse file)
            dataRefs.input.addEventListener('change', event => {
                dataRefs.files = event.target.files;
                handleFiles(dataRefs);
            }, false);
        };

        // Initialize drop zones on page
        const dropZones = document.querySelectorAll('.upload_dropZone');
        for (const zone of dropZones) {
            eventHandlers(zone);
        }

        // Allow only JPG/PNG/SVG files (no GIF/PDF/webp)
        const isImageFile = file => ['image/jpeg', 'image/png', 'image/svg+xml'].includes(file.type);

        // Show image preview
        function previewFiles(dataRefs) {
            if (!dataRefs.gallery) return;
            for (const file of dataRefs.files) {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function () {
                    let img = document.createElement('img');
                    img.className = 'upload_img mt-2';
                    img.setAttribute('alt', file.name);
                    img.src = reader.result;
                    dataRefs.gallery.appendChild(img);
                }
            }
        }

        // Upload file to server (if needed)
        const imageUpload = dataRefs => {
            if (!dataRefs.files || !dataRefs.input) return;
            const url = dataRefs.input.getAttribute('data-post-url');
            const name = dataRefs.input.getAttribute('data-post-name');
            if (!url || !name) return;

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
                }
            })
            .catch(error => {
                console.error('upload error: ', error);
            });
        }

        // Process valid images
        const handleFiles = dataRefs => {
            let files = [...dataRefs.files];
            files = files.filter(item => isImageFile(item));
            if (!files.length) return;
            dataRefs.files = files;

            previewFiles(dataRefs);
            imageUpload(dataRefs);
        }

    })();
    </script>
    {{-- Drag & Drop File Upload Logic END --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.getElementById('chat-file');
            const fileNamePreview = document.getElementById('selected-file-name');

            fileInput.addEventListener('change', function () {
                if (fileInput.files.length > 0) {
                    fileNamePreview.textContent = `Selected file: ${fileInput.files[0].name}`;
                } else {
                    fileNamePreview.textContent = ''; // Clear if no file
                }
            });
        });
    </script>

    {{-- Chatt Load --}}
    <script>
        setTimeout(() => {
            const chatBox = document.getElementById('chat-box');
            if (!chatBox) {
                console.error('❌ chatBox not found after 300ms.');
                return;
            }
            loadMessages();
            setInterval(loadMessages, 5000);
        }, 300);
    </script>

    <script>
        let lastMessageId = 0;

        document.getElementById('message-input').addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault(); // Prevents new line
                document.getElementById('send-message').click(); // Trigger send
            }
        });

        function renderMessage(msg) {
            const isMe = msg.user_id == {{ auth()->id() }};
            const name = msg.user?.name || `User ${msg.user_id}`;
            const avatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}`;
            const time = new Date(msg.created_at).toLocaleTimeString();

            const gif = msg.gif_url ? `<img src="${msg.gif_url}" class="img-fluid rounded my-2" style="max-width: 200px;">` : '';
            const text = msg.message ? `<div class="mb-1">${msg.message}</div>` : '';

            let attachmentHtml = '';

            if (msg.attachment) {
                const path = `/${msg.attachment.file_path}`;
                const name = msg.attachment.original_name;
                const ext = name.split('.').pop().toLowerCase();

                const imageExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                const videoExts = ['mp4', 'webm', 'mov'];
                const audioExts = ['mp3', 'wav', 'ogg'];

                const fileIcons = {
                    pdf: 'pdf', php: 'php', pub: 'publisher',
                    doc: 'word', docx: 'word', xls: 'excel',
                    xlsx: 'excel', sql: 'sql', zip: 'zip',
                    rar: 'zip', psd: 'psd', ai: 'ai',
                    indd: 'indesign', mp3: 'music', wav: 'music',
                    ogg: 'music', mp4: 'video', webm: 'video',
                    mov: 'video', txt: 'text', csv: 'excel',
                    json: 'json', default: 'file'
                };

                const iconKey = fileIcons[ext] || fileIcons.default;
                const iconUrl = `https://s2.svgbox.net/files.svg?ic=${iconKey}`;

                if (imageExts.includes(ext)) {
                    attachmentHtml = `<div class="mt-2"><a href="${path}" target="_blank"><img src="${path}" class="img-fluid rounded shadow" style="max-height: 200px;"></a><div class="small mt-1 text-truncate">${name}</div></div>`;
                } else if (audioExts.includes(ext)) {
                    attachmentHtml = `<div class="mt-2"><audio controls class="w-100"><source src="${path}" type="audio/${ext}">Your browser does not support audio.</audio><div class="small mt-1 text-truncate">${name}</div></div>`;
                } else if (videoExts.includes(ext)) {
                    attachmentHtml = `<div class="mt-2"><video controls class="w-100" style="max-height: 200px;"><source src="${path}" type="video/${ext}">Your browser does not support video.</video><div class="small mt-1 text-truncate">${name}</div></div>`;
                } else {
                    attachmentHtml = `<div class="mt-2"><a href="${path}" target="_blank" class="text-decoration-none d-flex align-items-center gap-2"><img src="${iconUrl}" alt="${ext}" style="height: 40px;"> <span class="text-truncate small" style="max-width: 200px;">${name}</span></a></div>`;
                }
            }

            return `
                <div class="d-flex mb-3 chat-message ${isMe ? 'justify-content-end your-message' : 'others-message'}" data-message-id="${msg.id}">
                    ${!isMe ? `<img class="avatar-image avatar-md rounded-circle me-2" src="${avatar}" width="40">` : ''}
                    <div>
                        <div class="${isMe ? 'bg-primary text-white' : 'bg-light'} p-2 rounded-3">
                            <div class="fw-bold">${isMe ? 'You' : name}
                                <small class="${isMe ? 'text-light' : 'text-muted'} ms-2">${time}</small>
                            </div>
                            ${text + gif + attachmentHtml}
                        </div>
                    </div>
                    ${isMe ? `<img class="avatar-image avatar-md rounded-circle ms-2" src="${avatar}" width="40">` : ''}
                </div>
            `;
        }


        document.getElementById('send-message').addEventListener('click', () => {
            const messageInput = document.getElementById('message-input');
            const fileInput = document.getElementById('chat-file');
            const message = messageInput.innerHTML.trim();
            const gif = message.includes('<img') ? $(message).find('img').attr('src') : null;
            const text = gif ? message.replace(/<img.*?>/g, '').trim() : message;
            const projectid = $('.project_id').val();

            const formData = new FormData();
            formData.append('message', text);
            formData.append('project_id', projectid);
            if (gif) formData.append('gif_url', gif);
            if (fileInput.files.length > 0) {
                formData.append('file', fileInput.files[0]);
            }

            fetch("{{ route('chat.send') }}", {
                method: "POST",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            }).then(res => res.json())
            .then(data => {
                messageInput.innerHTML = '';
                fileInput.value = '';
                loadMessages(); // refresh chat
            });
        });

        function loadMessages() {
            const baseUrl = "{{ route('chat.get', ['projectid' => 'PROJECT_ID']) }}";
            const projectid = $('.project_id').val();
            const finalUrl = baseUrl.replace('PROJECT_ID', projectid);

            fetch(finalUrl)
                .then(response => response.json())
                .then(data => {
                    const chatBox = document.getElementById('chat-box');
                    if (!chatBox) return;

                    const messages = data.messages;
                    const newMessages = messages.filter(msg => msg.id > lastMessageId);

                    newMessages.forEach(msg => {
                        chatBox.innerHTML += renderMessage(msg);
                        lastMessageId = msg.id;
                    });

                    if (newMessages.length) {
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                });
        }

    </script>
    {{-- Chatt Load End--}}

    {{-- LOAD MORE CHATT --}}
    <script>
        document.getElementById('loadMoreMessages').addEventListener('click', function () {
            const button = this;
            const offset = parseInt(button.getAttribute('data-offset'));

            fetch(`/chat/load-more?offset=${offset}`)
                .then(res => res.json())
                .then(data => {
                    if (data.messages.length > 0) {
                        const chatBox = document.getElementById('chat-box');
                        data.messages.forEach(msg => {
                            // Optional: avoid adding if already exists
                            if (!document.getElementById(`msg-${msg.id}`)) {
                                const msgDiv = document.createElement('div');
                                msgDiv.id = `msg-${msg.id}`;
                                msgDiv.textContent = msg.message;
                                chatBox.prepend(msgDiv);
                            }
                        });

                        // ✅ Only increase offset if we actually added new messages
                        button.setAttribute('data-offset', data.nextOffset);
                    } else {
                        // ❌ No new unique messages — hide button
                        button.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error loading more messages:', error);
                    alert("Something went wrong. Please try again.");
                });
        });
    </script>
    {{-- LOAD MORE CHATT END--}}


    {{-- Emoji Picker Integration --}}
    <!-- Emoji Picker from CDN -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js">
    </script>
    <style>
        emoji-picker {
            position: absolute;
            bottom: 60px;
            right: 50px;
            z-index: 999;
            max-height: 300px;
        }
    </style>

    <script>
    // Toggle emoji picker visibility
    document.getElementById('emoji-btn').addEventListener('click', () => {
        const picker = document.getElementById('emoji-picker');
        picker.classList.toggle('d-none');
    });

    // Insert emoji into message editor (div#message-input)
    document.getElementById('emoji-picker').addEventListener('emoji-click', event => {
        const emoji = event.detail.unicode;
        const input = document.getElementById('message-input');
        input.innerHTML += emoji;
    });
    </script>
    {{-- Emoji Picker Integration End --}}

    {{-- Tenor GIF Picker Logic --}}
    <script>
    const gifBtn = document.getElementById('gif-btn');
    const gifModal = document.getElementById('gif-modal');
    const gifResults = document.getElementById('gif-results');
    const gifSearch = document.getElementById('gif-search');
    const messageInput = document.getElementById('message-input');

    // Toggle GIF modal
    gifBtn.addEventListener('click', () => {
        gifModal.classList.toggle('d-none');
        loadGIFs(); // default: trending
    });

    // Search GIFs when typing
    gifSearch.addEventListener('input', () => {
        loadGIFs(gifSearch.value);
    });

    // Load Tenor GIFs
    function loadGIFs(query = 'trending') {
        const apiKey = 'AIzaSyDAvu_eEEFEgbhkB5pa_t_Pz02_U_b8voY';
        const url = `https://tenor.googleapis.com/v2/search?q=${encodeURIComponent(query)}&key=${apiKey}&limit=12`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                gifResults.innerHTML = '';
                if (!data.results.length) {
                    gifResults.innerHTML = '<p>No GIFs found.</p>';
                    return;
                }

                // Render each GIF
                data.results.forEach(gif => {
                    const img = document.createElement('img');
                    img.src = gif.media_formats?.tinygif?.url || '';
                    img.alt = gif.content_description || 'GIF';
                    img.style.width = '100px';
                    img.style.cursor = 'pointer';
                    img.classList.add('mb-2', 'me-2');

                    // On click, insert GIF <img> in contenteditable
                    img.onclick = () => {
                        messageInput.innerHTML += `<img src="${img.src}" class="img-fluid rounded my-2" style="max-width: 200px;">`;
                        gifModal.classList.add('d-none');
                    };

                    gifResults.appendChild(img);
                });
            })
            .catch(error => {
                console.error('Error fetching GIFs:', error);
                gifResults.innerHTML = '<p>Error loading GIFs.</p>';
            });
    }
    </script>
    {{-- Tenor GIF Picker Logic End --}}
@endsection
