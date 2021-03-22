<x-client-layout :store="$store">
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form id="create-product-form" action="/admin/products" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Create Product</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>

                                    <div class="col-sm-12 col-md-7">
                                        <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                                        <div class="@error('name') is-invalid @enderror"></div>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Categories</label>

                                    <div class="col-sm-12 col-md-7">
                                        <x-form.multi-select name="categories" :data="$categories"></x-form.multi-select>
                                        <div class="@error('categories') is-invalid @enderror"></div>

                                        @error('categories')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Php
                                                </div>
                                            </div>
                                            <input name="price" type="number" class="currency form-control" value="{{ old('price') }}">
                                        </div>
                                        <div class="@error('price') is-invalid @enderror"></div>

                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>

                                    <div class="col-sm-12 col-md-7">
                                        <x-form.editor name="description" class="@error('price') is-invalid @enderror"></x-form.editor>

                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                    <div class="col-sm-12 col-md-7">
                                        <x-form.thumbnail-image name="thumbnail" class="@error('thumbnail') is-invalid @enderror">
                                        </x-form.thumbnail-image>

                                        @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="is_active" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>

                                        <div class="@error('is_active') is-invalid @enderror"></div>

                                        @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Images</label>
                                    <div class="col-sm-12 col-md-7">
                                        <x-form.file-uploader name="images" accepts="image/*" class="@error('images') is-invalid @enderror"></x-form.file-uploader>

                                        @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                <a href="/admin/products" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-client-layout>