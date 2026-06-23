@props([
    'type' => 'button',
    'variant' => 'primary', // 'primary', 'secondary', 'success', 'warning', 'danger'
    'outline' => false,
    'size' => 'md', // 'sm', 'md', 'lg'
    'icon' => null,
    'iconPosition' => 'left', // 'left' or 'right'
    'href' => null
])
@php
    // If old style variant="outline" was used, default to outline-secondary
    if ($variant === 'outline') {
        $variant = 'outline-secondary';
    }

    // Support boolean <x-ui.button outline variant="danger" />
    if ($outline && !str_starts_with($variant, 'outline-')) {
        $variant = "outline-{$variant}";
    }

    $sizeClasses = [
        'sm' => 'btn-sm',
        'md' => '',
        'lg' => 'btn-lg',
    ];

    $sizeClass = $sizeClasses[$size] ?? '';
    $btnClass = "btn-{$variant}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "btn btn-modern {$btnClass} {$sizeClass}"])->except('outline') }}>
        @if($icon && $iconPosition === 'left')
            <i class="{{ $icon }} me-2"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} ms-2"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "btn btn-modern {$btnClass} {$sizeClass}"])->except('outline') }}>
        @if($icon && $iconPosition === 'left')
            <i class="{{ $icon }} me-2"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} ms-2"></i>
        @endif
    </button>
@endif
