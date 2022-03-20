@extends('layouts.admin.permission')
@section('title')
    Permissions
@endsection
@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5>Permissions</h5>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-responsive table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 60px">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col" style="width: 200px"></th>
                </tr>
            </thead>

            <tbody>
                @if (count($Permissions) == 0)
                <tr>
                    <td class="text-center text-danger" colSpan="12">No Permissions Found</td>
                </tr>

                @else
                    @foreach ($Permissions as $item)
                        <tr>
                            <td>{{$item->id}}</td>

                            <td>{{$item->name}}</td>

                            <td>
                                @can('role-list')
                                <a class="btn btn-success" href="{{route('permissions.show',['permission'=>$item->id]);}}"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('role-edit')
                                    <a class="btn btn-primary" href="{{route('permissions.edit',['permission'=>$item->id]);}}"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('role-delete')

                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="card-footer d-flex justify-content-end bg-white shadow">
            {{ $Permissions->links() }}
        </div>
    </div>
</div>
@stop