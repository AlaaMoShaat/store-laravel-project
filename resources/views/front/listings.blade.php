@extends('front.parent')


@section('title', 'Home')


@section('styles')

@endsection

@section('content')

    <main>
        <!-- Search -->
        @include('partials._search')

        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
            <!-- Item 1 -->
            @foreach ($listings as $listing)
                <x-front.listing-card :listing="$listing" />
            @endforeach
        </div>
        <div class="p-4 flex justify-center	">
            {{ $listings->links() }}
        </div>
    </main>

@endsection


@section('scripts')

@endsection
