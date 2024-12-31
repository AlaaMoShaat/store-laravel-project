@props(['listing'])
<x-front.card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block"
            src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('front/images/acme.png') }}"
            alt="" />
        <div>
            <h3 class="text-2xl">
                <a href="{{ Route('detailes', $listing->id) }}">{{ $listing->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
            <x-front.listing-tags :tagsCsv="$listing->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
            </div>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-address-book"></i> <a href="{{ $listing->email }}">{{ $listing->email }}</a>
            </div>
        </div>
    </div>
</x-front.card>
