<div wire:ignore.self x-data="{ open: false }">
    <button x-on:click="open = true">Print</button>

    <div x-show="open" class="fixed inset-0 bg-gray-500/50 opacity-75 transition-all ease-in-out duration-300">
        <div class="relative p-4 bg-white rounded-md m-auto w-full max-w-sm">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium">Print Record</h3>
                <button x-on:click="open = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-4" wire:ignore>
                <div x-html="dataToPrint"></div>
            </div>
            <div class="mt-4 flex justify-end space-x-2">
                <button class="btn-secondary" x-on:click="open = false">Close</button>
                <button class="btn-primary" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', () => {
        window.addEventListener('print-record', event => {
            this.dataToPrint = event.detail; // Access data from Livewire event
        });
    });
</script>
