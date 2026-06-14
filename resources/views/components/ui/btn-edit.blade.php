@props([
    'size' => 'sm', // 'sm', 'md', 'lg'
    'tooltip' => 'Edit',
    'iconOnly' => false,
    'label' => 'Edit'
])

@php
    $baseStyle = 'display: inline-flex; align-items: center; justify-content: center; white-space: nowrap; ';
    $sizeStyles = [
        'sm' => $baseStyle . 'font-size: 0.8rem;' . ($iconOnly ? ' width: 32px; height: 32px; padding: 0;' : ''),
        'md' => $baseStyle . 'font-size: 0.9rem;' . ($iconOnly ? ' width: 38px; height: 38px; padding: 0;' : ''),
        'lg' => $baseStyle . 'font-size: 1rem;' . ($iconOnly ? ' width: 44px; height: 44px; padding: 0;' : ''),
    ];

    $btnSize = $sizeStyles[$size] ?? $sizeStyles['sm'];
@endphp

<x-ui.button
    variant="primary"
    :size="$size"
    title="{{ $tooltip }}"
    {{ $attributes->merge(['class' => 'action-btn action-btn-edit', 'style' => $btnSize]) }}
>
    <i class="fas fa-edit {{ !$iconOnly ? 'me-1' : '' }}"></i>
    @if(!$iconOnly)
        <span>{{ $slot->isEmpty() ? $label : $slot }}</span>
    @endif
</x-ui.button>
