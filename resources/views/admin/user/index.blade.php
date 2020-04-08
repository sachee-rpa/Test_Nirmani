@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    @include('layouts.inc.page-title')
    <div class="main-card mb-3 card">
        <div class="card-body">
            @include('layouts.inc.success')
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>SA</th>
                        <th>S</th>
                        <th>M</th>
                        <th>W</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->designation }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{!! $user->super_admin == 1 ? '<i class="fa fa-check fa-w-20 red"></i>': '' !!}</td>
                        <td>{!! $user->spares == 1 ? '<i class="fa fa-check fa-w-20 green"></i>': '' !!}</td>
                        <td>{!! $user->machine == 1 ? '<i class="fa fa-check fa-w-20 green"></i>': '' !!}</td>
                        <td>{!! $user->workshop == 1 ? '<i class="fa fa-check fa-w-20 green"></i>': '' !!}</td>
                        <td>
                            <a href="{{ route('users.show', $user)  }}" class="btn  btn-icon btn-warning btn-sm"
                                href="#" role="button">
                                <i class="pe-7s-note btn-icon-wrapper"> </i>
                                Edit</a>
                        </td>
                        <td>
                            <form class="delete" action="{{ route('users.destroy', $user)  }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" title="Delete" class="btn btn-danger btn-sm">
                                    <i class="pe-7s-trash "> </i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No Data...</td>
                    </tr>
                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>SA</th>
                        <th>S</th>
                        <th>M</th>
                        <th>W</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection