<div x-data="clinicianSearch()" class="container flex justify-center mx-auto">
    <template x-on:modal.window="open = $event.detail.open; clinicianid = $event.detail.clinicianid ;
        Type = $event.detail.Type; Title = $event.detail.Title;
        fetchClinician();"></template>
    <template x-if="clinician">
        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50" x-cloak>
            <div @click.away="closeClinician()" class=" max-w-4xl p-6 bg-white" x-show="open" x-cloak>
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl" x-text="Title"></h3>
                    <svg @click="closeClinician()" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="mt-4">
                    <form onsubmit="return false;">
                        <div class="mb-4 text-sm" x-html="clinician.html"></div>
                        <div class="flex justify-between">
                            <x-forms.button class="bg-red-500" @click="closeClinician()">Cancel</x-forms.button>
                            <x-forms.button type="submit" class="bg-green-500">Save</x-forms.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
