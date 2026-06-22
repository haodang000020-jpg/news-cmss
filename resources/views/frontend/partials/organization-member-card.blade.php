@php
    $variant = $variant ?? 'staff';

    $initial = mb_strtoupper(
        mb_substr(trim($member->name), 0, 1)
    );

    $phoneHref = $member->phone
        ? preg_replace('/[^\d+]/', '', $member->phone)
        : null;
@endphp

<article class="organization-member-card organization-member-card--{{ $variant }}">
    <div class="organization-member-photo-wrap">
        @if ($member->photo_path)
            <img
                src="{{ asset('storage/' . $member->photo_path) }}"
                alt="{{ $member->name }}"
                class="organization-member-photo"
            >
        @else
            <div class="organization-member-photo organization-member-photo-placeholder">
                {{ $initial }}
            </div>
        @endif
    </div>

    <div class="organization-member-level">
        {{ $member->level_label }}
    </div>

    <h3 class="organization-member-name">
        {{ $member->name }}
    </h3>

   
    @if ($member->responsibility)
        <div class="organization-member-responsibility">
            <strong>Lĩnh vực phụ trách:</strong>

            <p>{{ $member->responsibility }}</p>
        </div>
    @endif

    <div class="organization-member-contact">
        @if ($member->phone)
            <a href="tel:{{ $phoneHref }}">
                <span>☎</span>
                {{ $member->phone }}
            </a>
        @endif

        @if ($member->email)
            <a href="mailto:{{ $member->email }}">
                <span>✉</span>
                {{ $member->email }}
            </a>
        @endif
    </div>

</article>

