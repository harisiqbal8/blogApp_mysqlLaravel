<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form action="/admin/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" onkeypress="showButton()" onfocusout="hideButton()" :value="old('title', $post->title)" required />
            <x-form.input name="slug" :value="old('slug', $post->slug)" required />

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                </div>
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>

            <x-form.textarea name="excerpt">
                {{ old('excerpt', $post->excerpt) }}
            </x-form.textarea>

            <div class="mb-6">
                <div class="flex mb-2 justify-between">
                    <x-form.label name="body" />
                    <a href="javascript:void(0)"
                    class="block uppercase font-bold text-xs text-blue-500 hover:text-blue-600"
                    style="display: none"
                    id="generateButton"
                    onclick="generateText()"><span class="text-base"><i class="fa fa-magic"> </i> </span> Write with
                    AI</a>
                    <div class="animate-spin text-blue-500 font-bold" style="display: none" id="promptLoader">( )</div>
                </div>
                <textarea 
                    class="border border-gray-200 p-2 w-full rounded" 
                    type="textarea" 
                    name="body" 
                    id="body" 
                    required>{{ old('body', $post->body) }}</textarea>
                <x-form.error name="body" />
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category_id">
                    Category
                </label>

                <select name="category_id" id="category_id">

                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category" />
            </div>

            <x-submit-button>Update</x-submit-button>

        </form>
    </x-setting>
</x-layout>