@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                 <a href="{{ route('add.amenities') }}" class="btn btn-info">Add Amenitie</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Amenities</h2>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amenitie Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data => $item)
                                        <tr>
                                            <td>{{ $data+1 }}</td>
                                            <td>{{ $item->amenities_name }}</td>
                                            <td>
                                                <a href="{{ route('edit.amenities', $item->id) }}" class="btn btn-warning">Edit</a>
                                                <a href="{{ route('destroy.amenities', $item->id) }}" class="btn btn-danger" id="delete">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
