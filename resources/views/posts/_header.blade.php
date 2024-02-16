<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Laravel From Scratch</span> News
    </h1>

    <div class="space-y-2 lg:space-x-4 mt-4">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
            <x-category-dropdown />
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="/">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" placeholder="Find something"
                    class="bg-transparent placeholder-black font-semibold text-sm" value="{{ request('search') }}">
            </form>
        </div>
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="/">
                <input type="datetime-local" name="startDate" placeholder="date"
                    class="bg-transparent placeholder-black font-semibold text-sm" value="{{ request('startDate') }}">
                <input type="datetime-local" name="endDate" placeholder="date"
                    class="bg-transparent placeholder-black font-semibold text-sm" value="{{ request('endDate') }}">
                <button type="submit" class="text-sm font-semibold">Filter Date</button>
            </form>
        </div>

        @if ($latestPost)
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                <a class="font-semibold text-sm">Latest Posts: {{ $latestPost }}</a>
            </div>
        @endif
    </div>
</header>
