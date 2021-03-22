<x-client-layout :store="$store">
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
        </div>

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a class="btn ml-2 btn-primary" href="/admin/products/create">
                        Add New Product
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>SKU</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($products->items() as $product)
                                <tr>
                                    <td width="20px" class="p-0">
                                        <img class="img-thumbnail" style="border: none;" src="{{ $product->thumbnail }}" alt="">
                                    </td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <div class="badge badge-{{ $product->is_active ? 'success' : 'danger'}}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/admin/products/{{$product->id}}" class="btn btn-info">
                                            <i class="fas fa-sitemap"></i>
                                            Sub products
                                        </a>
                                        <a href="/admin/products/{{$product->id}}/edit" class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <a class="btn btn-warning" data-toggle="modal" data-target="#deleteCategory" data-action="/admin/products/{{$product->id}}">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="deleteCategory" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        Are you sure you want to delete ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $('#deleteCategory').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            console.log(action)
            var modal = $(this);
            modal.find('form').attr('action', action);
        });
    </script>
    @endpush

</x-client-layout>