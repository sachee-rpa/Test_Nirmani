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
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>CP</th>
                        <th>CL</th>
                        <th>Country</th>
                        <th>F-M-F</th>
                        <th>Email</th>
                        <th>VAT</th>
                        <th>SVAT</th>
                        <th>Remark</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($objects as $object)
                    <tr>
                        <td>{{ $object->id }}</td>
                        <td>{{ $object->name }}</td>
                        <td>{{ $object->address }}</td>
                        <td>{{ $object->credit_period }}</td>
                        <td>{{ $object->credit_limit }}</td>
                        <td>{{ $object->country->name }}</td>
                        <td>
                            {{ $object->fixed_line }} ,
                            {{ $object->mobile }} ,
                            {{ $object->fax }} ,
                        </td>
                        <td>{{ $object->email }}</td>
                        <td>{{ $object->vat }}</td>
                        <td>{{ $object->svat }}</td>
                        <td>{{ $object->remark }}</td>
                        <td>
                            <a href="{{ route($route_name.'show', $object)  }}" class="btn  btn-icon btn-warning btn-sm"
                            href="#" role="button">
                            <i class="pe-7s-note btn-icon-wrapper"> </i>
                            Edit</a>
                        </td>
                        <td>
                            <form class="delete" action="{{ route($route_name.'destroy', $object)  }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" title="Delete" class="btn btn-danger btn-sm">
                                    <i class="pe-7s-trash "> </i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty

                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>CP</th>
                        <th>CL</th>
                        <th>Country</th>
                        <th>F-M-F</th>
                        <th>Email</th>
                        <th>VAT</th>
                        <th>SVAT</th>
                        <th>Remark</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection



@if ($search ?? '')
@section('search')
@includeWhen($search ?? '', 'admin.supplier.search')
@endsection
@endif