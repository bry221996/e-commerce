<x-client-layout :store="$store">
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $category->title }} Sub Categories</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($subCategories->items() as $category)
                                <tr>
                                    <td width="20%">{{ $category->title }}</td>
                                    <td width="45%">{{ $category->description }}</td>
                                    <td>
                                        <div class="badge badge-{{ $category->is_active ? 'success' : 'danger'}}">
                                            {{ $category->status }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/admin/categories/{{$category->id}}/edit" class="btn btn-secondary">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <a class="btn btn-warning" data-toggle="modal" data-target="#deleteCategory" data-action="/admin/categories/{{$category->id}}">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $subCategories->links() }}
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