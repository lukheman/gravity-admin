@props([
    'title' => '',
    'closeAction' => 'closeModal'
])

<div class="modal-backdrop-custom" wire:click.self="{{ $closeAction }}">
    <div class="modal-content-custom" wire:click.stop>
        <div class="modal-header-custom">
            <h5 class="modal-title-custom">
                {{ $title }}
            </h5>
            <button type="button" class="modal-close-btn" wire:click="{{ $closeAction }}">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{ $slot }}
    </div>
</div>
