@extends('layouts.admin.users')
@section('title')
    Users
@endsection
@section('content')
<div class="card mb-5 shadow">
    <div class="card-header">
        <h5>Users</h5>
    </div>

    <div class="card-body p-0">
        <table class="table table-responsive table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 60px">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Privilege</th>
                    <th scope="col" style="width: 120px"></th>
                </tr>
            </thead>

            <tbody>
                @if (count($users) == 0)
                <tr>
                    <td class="text-center text-danger" colSpan="12">No Roles Found</td>
                </tr>

                @else
                    <?php $count = 1?>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->telephone}}</td>
                            <td>{{$item->gender}}</td>
                            <td>{{$item->privilege}}</td>
                            
                            <td>
                                @can('role-list')
                                <a class="btn btn-success"  href="{{route('users.show',['user'=>$item->id]);}}"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('role-edit')
                                    <a class="btn btn-primary"href="{{route('users.edit',['user'=>$item->id]);}}"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('role-delete')

                                @endcan
                            </td>
                        </tr>
                        <?php $count++?>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex justify-content-end bg-white shadow">
        {{ $users->links() }}
    </div>
</div>
@endsection