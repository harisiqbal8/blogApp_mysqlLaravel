<x-layout>
    <x-setting heading="Manage Posts">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>

                    @foreach ($posts as $post)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="/post/{{ $post->slug }}">
                                    {{ $post->title }}
                                </a>
                            </th>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 border border-green-300 rounded-full text-green-300 text-xs uppercase font-semibold"
                                    style="font-size: 10px">
                                    Published
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/admin/posts/{{ $post->id }}/edit"
                                    class="font-medium text-blue-600 hover:text-blue-500">Edit</a>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="/admin/posts/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-xs text-gray-400">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </x-setting>
</x-layout>
