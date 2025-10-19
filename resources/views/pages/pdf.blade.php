<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CV - {{ $user->full_name }}</title>
    <style>
        :root {
            --primary-color: #3b82f6;
            --text-color: #1f2937;
            --text-secondary: #4b5563;
            --bg-light: #f9fafb;
            --border-radius: 0.5rem;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            height: 120px;
            width: 100%;
            margin-bottom: 60px;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: -90px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            text-align: center;
            margin-top: 15px;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-color);
        }

        .profile-title {
            font-size: 0.9rem;
            color: var(--primary-color);
            margin: 0.25rem 0;
            font-weight: 500;
        }

        .profile-contact {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 0.75rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .section {
            margin-bottom: 1.5rem;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 0.25rem;
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
            padding: 0.75rem;
            border-radius: var(--border-radius);
            margin-bottom: 0.75rem;
        }

        .experience-item,
        .education-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
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
            font-size: 0.9rem;
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
        }

        .job-description,
        .education-details {
            margin-top: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .skill-item {
            background: #e0f2fe;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 500;
            color: #0369a1;
        }

        .reference-item {
            margin-bottom: 0.5rem;
            padding-left: 0.5rem;
            border-left: 2px solid var(--primary-color);
            font-size: 0.8rem;
        }

        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 1cm;
        }
    </style>
</head>

<body>
    <div class="header"></div>

    <div class="profile-container">
        @php
            $images = json_decode($user->images, true);
            $profile = $images[0] ?? null;
        @endphp

        @if ($profile)
            <img src="{{ public_path('storage/' . $profile) }}" alt="Profile Picture" class="profile-img">
        @endif

        <div class="profile-info">
            <h1 class="profile-name">{{ $user->full_name }}</h1>
            @if ($user->title)
                <p class="profile-title">{{ $user->title }}</p>
            @endif

            <div class="profile-contact">
                @if ($user->location)
                    <div class="contact-item">
                        <span>{{ $user->location }}</span>
                    </div>
                @endif

                @if ($user->email)
                    <div class="contact-item">
                        <span>{{ $user->email }}</span>
                    </div>
                @endif

                @if ($user->phone)
                    <div class="contact-item">
                        <span>{{ $user->phone }}</span>
                    </div>
                @endif

                @if ($user->linkedin)
                    <div class="contact-item">
                        <span>{{ parse_url($user->linkedin, PHP_URL_HOST) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="content">
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
                            <p class="duration">{{ $exp['duration'] ?? '' }}</p>
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
                            <p class="duration">Graduated: {{ $edu['year'] ?? '' }}</p>
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
</body>

</html>
