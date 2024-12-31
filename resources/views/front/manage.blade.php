@extends('front.parent')


@section('title', 'Manage')


@section('styles')

@endsection



@section('content')


    <main>
        <!-- Search -->
        @include('partials._search')

        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                <header>
                    <h1 class="text-3xl text-center font-bold my-6 uppercase">
                        Manage Gigs
                    </h1>
                </header>

                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        @unless ($listings->isEmpty())
                            @foreach ($listings as $listing)
                                <tr class="border-gray-300">
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                        <a class="flex items-center " href="{{ Route('detailes', $listing->id) }}">
                                            <img class="hidden w-12 mr-6 md:block"
                                                src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('front/images/acme.png') }}"
                                                alt="" />
                                            {{ $listing->title }} </a>
                                    </td>
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                        <a href="{{ Route('edit', $listing->id) }}"
                                            class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i>
                                            Edit</a>
                                    </td>
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                        <form method="POST" action="{{ Route('delete', $listing->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <p class="text-center">No Listings Found</p>
                                </td>
                            </tr>
                        @endunless

                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection


@section('scripts')

@endsection
