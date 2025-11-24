@extends('admin.app')
@section('title', 'Varietas Benih')

@section('content')

<div class="container-fluid">

    <h4 class="mb-3">Varietas Benih</h4>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-success text-white">Menu</div>
                <ul class="list-group list-group-flush">
                    <a href="{{ route('admin.varieties.index') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-list mr-2"></i> List Varietas
                    </a>
                    <a href="{{ route('admin.varieties.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-plus mr-2"></i> Tambah Varietas
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">

                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">List Varietas Benih</h5>
                </div>

                <div class="card-body p-0">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th width="120">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($varieties as $i => $v)
                        <tr>
                            <td>{{ $varieties->firstItem() + $i }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->type ?? '-' }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.varieties.edit', $v->id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.varieties.destroy', $v->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus varietas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($varieties->count() == 0)
                        <tr>
                            <td colspan="4" class="text-center py-3 text-muted">
                                Tidak ada data.
                            </td>
                        </tr>
                        @endif
                        </tbody>

                    </table>
                </div>

                <div class="card-footer">
                    {{ $varieties->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
