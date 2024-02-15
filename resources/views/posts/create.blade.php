<x-layout>
    <section class="py-8 max-w-4xl mx-auto"> 
        <h1 class="text-lg font-bold mb-4">
            Publish a Post!
        </h1>
        <x-panel>
            <form action="/admin/posts" method="post" enctype="multipart/form-data">
                @csrf
                <x-form.input name="title" onkeypress="showButton()" onfocusout="hideButton()" />
                <x-form.input name="slug" />
                <x-form.input name="thumbnail" type="file" />

                <x-form.textarea name="excerpt" />
                <x-form.textarea name="body">
                    <a href="javascript:void(0)"
                        class="block uppercase font-bold text-xs text-blue-500 hover:text-blue-600"
                        style="display: none"
                        id="generateButton"
                        onclick="generateText()"><span class="text-base"><i class="fa fa-magic"> </i> </span> Write with
                        AI</a>
                        <div class="animate-spin text-blue-500 font-bold" style="display: none" id="promptLoader">( )</div>
                </x-form.textarea>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category_id">
                        Category
                    </label>

                    <select name="category_id" id="category_id">

                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ ucwords($category->name) }}</option>
                        @endforeach
                    </select>

                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-submit-button>Publish</x-submit-button>

            </form>
        </x-panel>
    </section>
</x-layout>
