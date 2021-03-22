<x-client-layout :store="$store">
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="/admin/categories" method="post">
                    @csrf
                    <div class="card-header">
                        <h4>Create Product Categories</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">

                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Parent</label>
                            <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" value="{{ old('parent_id') }}">
                                <option value="">Select Parent Category</option>
                                @foreach ($parentCategories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>

                            @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control h-auto @error('title') is-invalid @enderror" rows="5" value="{{ old('description') }}"></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="custom-switch mt-2 pl-0">
                                <input type="checkbox" name="is_active" class="custom-switch-input" value="1">
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