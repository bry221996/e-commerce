<x-client-layout :store="$store">
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="/admin/categories/{{$category->id}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-header">
                        <h4>Edit Product Categories</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $category->title }}">

                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Parent</label>
                            <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" value="{{ old('parent_id') }}">
                                <option value="">Select Parent Category</option>
                                @foreach ($parentCategories as $parentCategory)
                                <option value="{{$parentCategory->id}}">{{$parentCategory->title}}</option>
                                @endforeach
                            </select>

                            @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control h-auto @error('title') is-invalid @enderror" rows="5">{{ $category->description }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="custom-switch mt-2 pl-0">
                                <input type="checkbox" name="is_active" class="custom-switch-input" value="1" {!! $category->is_active ? 'checked' : '' !!}>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Is Active ? </span>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        <a href="/admin/categories" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-client-layout>