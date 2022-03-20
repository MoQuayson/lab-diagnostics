@extends('layouts.admin.roles')
@section('title')
    Roles
@endsection

@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Roles </h4>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-responsive table-hover table-striped shadow table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col" >ID</th>
                    <th scope="col" style="width: 300px">Name</th>
                    <th scope="col" style="width: 200px"></th>
                </tr>
            </thead>

            <tbody>
                @if (count($Roles) == 0)
                <tr>
                    <td class="text-center text-danger" colSpan="12">No Roles Found</td>
                </tr>

                @else
                    @foreach ($Roles as $item)
                        <tr>
                            <td>{{$item->id}}</td>

                            <td>{{$item->name}}</td>

                            <td>
                                @can('role-list')
                                <a class="btn btn-success" href="{{route('roles.show',['role'=>$item->id]);}}"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('role-edit')
                                    <a class="btn btn-primary" href="{{route('roles.edit',['role'=>$item->id]);}}"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('role-delete')

                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection