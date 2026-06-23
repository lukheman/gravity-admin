@props([
    'title' => '',
    'submitAction' => 'save',
    'closeAction' => 'closeModal',
    'submitLabel' => 'Simpan',
    'closeLabel' => 'Cancel',
    'submitVariant' => 'primary'
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

        <form wire:submit="{{ $submitAction }}">
            {{ $slot }}

            <div class="d-flex justify-content-end gap-2 mt-4">
                <x-ui.button type="button" variant="secondary" wire:click="{{ $closeAction }}">
                    {{ $closeLabel }}
                </x-ui.button>
                <x-ui.button type="submit" variant="{{ $submitVariant }}">
                    {{ $submitLabel }}
                </x-ui.button>
            </div>
        </form>
    </div>
</div>
