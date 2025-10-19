@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --text-color: #1f2937;
            --text-secondary: #4b5563;
            --bg-light: #f9fafb;
            --border-radius: 0.4rem;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-color);
            line-height: 1.4;
        }

        .cv-container {
            max-width: 900px;
            margin: 1rem auto;
            box-shadow: var(--shadow-md);
            border-radius: var(--border-radius);
            overflow: hidden;
            background: white;
        }

        .cover-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .profile-container {
            margin-top: -60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid white;
            object-fit: cover;
            box-shadow: var(--shadow-sm);
        }

        .profile-info {
            text-align: center;
            margin-top: 15px;
            /* margin-top: 0.75rem; */
            /* padding: 0 1rem; */
        }

        .profile-name {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-color);
        }

        .profile-title {
            font-size: 0.9rem;
            color: var(--primary-color);
            margin: 0.2rem 0;
            font-weight: 500;
        }

        .profile-contact {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .uniform-image {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 0.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .contact-item svg {
            width: 12px;
            height: 12px;
            fill: var(--primary-color);
        }

        .cv-content {
            padding: 1rem;
        }

        .section {
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 0.3rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .section-box {
            background: var(--bg-light);
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 0.5rem;
        }

        .experience-item,
        .education-item {
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .experience-item:last-child,
        .education-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .job-title,
        .degree {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.1rem;
        }

        .company,
        .institute {
            font-weight: 500;
            color: var(--primary-color);
            font-size: 0.85rem;
        }

        .duration {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin: 0.1rem 0;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .duration svg {
            width: 12px;
            height: 12px;
            fill: currentColor;
        }

        .job-description,
        .education-details {
            margin-top: 0.4rem;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            list-style: none;
            padding: 0;
        }

        .skill-item {
            background: #e0f2fe;
            padding: 0.3rem 0.7rem;
            border-radius: 16px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #0369a1;
        }

        .reference-item {
            margin-bottom: 0.6rem;
            padding-left: 0.6rem;
            border-left: 2px solid var(--primary-color);
            font-size: 0.85rem;
        }

        .print-btn {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 500;
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            z-index: 10;
            font-size: 0.9rem;
        }

        .download-btn {
            position: fixed;
            bottom: 1.5rem;
            right: 8rem;
            background: #10b981;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 500;
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            z-index: 10;
            font-size: 0.9rem;
        }

        /* If you want them stacked vertically */
        @media (max-width: 768px) {
            .download-btn {
                right: 1.5rem;
                bottom: 4.5rem;
            }
        }

        @media print {
            body {
                background: white !important;
                color: black !important;
                padding: 0 !important;
                margin: 0 !important;
                font-size: 10pt;
                line-height: 1.3;
            }

            .cv-container {
                box-shadow: none !important;
                margin: 0 !important;
                max-width: 100% !important;
                border: none !important;
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            .cover-photo {
                height: 140px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .profile-container {
                margin-top: -50px;
            }

            .profile-img,
            .uniform-image {
                border: 2px solid white;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .section-box {
                background: #f9fafb !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                page-break-inside: avoid;
            }

            .skill-item {
                background: #e0f2fe !important;
                color: #0369a1 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print,
            nav,
            header,
            footer,
            .print-btn,
            .download-btn {
                display: none !important;
            }

            a {
                text-decoration: none;
                color: inherit;
            }

            @page {
                size: A4;
                margin: 0.8cm;
            }
        }
    </style>

    <div class="cv-container">
        {{-- Cover Photo --}}
        <img src="{{ asset('storage/images/cover.png') }}" alt="Cover Photo" class="cover-photo">

        {{-- Profile Info --}}
        <div class="profile-container">
            @php
                $images = json_decode($user->images, true);
            @endphp

            @if (!empty($images))
                @foreach ($images as $img)
                    <img src="{{ asset('storage/' . $img) }}" alt="User Image" class="uniform-image">
                @endforeach
            @endif

            <div class="profile-info">
                <h1 class="profile-name">{{ $user->full_name }}</h1>
                @if ($user->title)
                    <p class="profile-title">{{ $user->title }}</p>
                @endif

                <div class="profile-contact">
                    @if ($user->location)
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                            <span>{{ $user->location }}</span>
                        </div>
                    @endif

                    @if ($user->email)
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            <span>{{ $user->email }}</span>
                        </div>
                    @endif

                    @if ($user->phone)
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z" />
                            </svg>
                            <span>{{ $user->phone }}</span>
                        </div>
                    @endif

                    @if ($user->linkedin)
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z" />
                            </svg>
                            <span><a href="{{ $user->linkedin }}"
                                    target="_blank">{{ parse_url($user->linkedin, PHP_URL_HOST) }}</a></span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="cv-content">
            {{-- Summary --}}
            @if ($user->summary)
                <div class="section">
                    <h2 class="section-title">Professional Summary</h2>
                    <div class="section-box">
                        <p>{{ $user->summary }}</p>
                    </div>
                </div>
            @endif

            {{-- Work Experience --}}
            <div class="section">
                <h2 class="section-title">Work Experience</h2>
                @php $experiences = json_decode($user->experience, true); @endphp
                @if (!empty($experiences))
                    @foreach ($experiences as $exp)
                        <div class="section-box experience-item">
                            <h3 class="job-title">{{ $exp['title'] ?? '' }}</h3>
                            <p class="company">{{ $exp['company'] ?? '' }}</p>
                            @if ($exp['duration'] ?? false)
                                <p class="duration">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                                    </svg>
                                    {{ $exp['duration'] ?? '' }}
                                </p>
                            @endif
                            @if ($exp['description'] ?? false)
                                <div class="job-description">
                                    {!! nl2br(e($exp['description'])) !!}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="section-box">
                        <p>No work experience provided.</p>
                    </div>
                @endif
            </div>

            {{-- Education --}}
            <div class="section">
                <h2 class="section-title">Education</h2>
                @php $educations = json_decode($user->education, true); @endphp
                @if (!empty($educations))
                    @foreach ($educations as $edu)
                        <div class="section-box education-item">
                            <h3 class="degree">{{ $edu['department'] ?? '' }}</h3>
                            <p class="institute">{{ $edu['institute'] ?? '' }}</p>
                            @if ($edu['year'] ?? false)
                                <p class="duration">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                                    </svg>
                                    Graduated: {{ $edu['year'] ?? '' }}
                                </p>
                            @endif
                            @if ($edu['result'] ?? false)
                                <div class="education-details">
                                    <strong>Result:</strong> {{ $edu['result'] ?? '' }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="section-box">
                        <p>No education details provided.</p>
                    </div>
                @endif
            </div>

            {{-- Skills --}}
            @if ($user->skills)
                <div class="section">
                    <h2 class="section-title">Skills</h2>
                    <div class="section-box">
                        @php
                            $skills = $user->skills ? explode(',', $user->skills) : [];
                        @endphp
                        @if (!empty($skills))
                            <ul class="skills-list">
                                @foreach ($skills as $skill)
                                    <li class="skill-item">{{ trim($skill) }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No skills listed.</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- References --}}
            @if ($user->references)
                <div class="section">
                    <h2 class="section-title">References</h2>
                    <div class="section-box">
                        @php $references = json_decode($user->references, true); @endphp
                        @if (!empty($references))
                            @foreach ($references as $ref)
                                <div class="reference-item">
                                    {!! nl2br(e($ref)) !!}
                                </div>
                            @endforeach
                        @else
                            <p>No references provided.</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- <button onclick="window.print()" class="print-btn no-print">Print CV</button> --}}
    <button onclick="downloadPDF('{{ $user->full_name }}')" class="print-btn no-print">Print CV</button>



    <script>
        document.addEventListener('DOMContentLoaded', function() {});

        function downloadPDF(fullName) {
            // Get the HTML content to print
            const cvContent = document.querySelector('.cv-container').outerHTML;
            const styles = document.querySelector('style').innerHTML;

            // Create a new window with the content
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>${fullName} - CV</title>
            <style>${styles}</style>
        </head>
        <body>
            ${cvContent}
            <script>
                window.onload = function() {
                    // For Chrome - trigger print and suggest filename
                    if (window.chrome) {
                        document.title = "${fullName}_CV";
                        window.print();
                        setTimeout(function() {
                            window.close();
                        }, 1000);
                    } 
                    // For other browsers
                    else {
                        window.print();
                        setTimeout(function() {
                            window.close();
                        }, 1000);
                    }
                };
            <\/script>
        </body>
        </html>
    `);
            printWindow.document.close();

            // For browsers that support the "beforeprint" event
            window.addEventListener('beforeprint', function() {
                document.title = `${fullName} - CV`;
            });
        }
    </script>
@endsection
