@extends('layouts.app')

@section('content')
<div class="app-main__inner">
    @include('layouts.inc.page-title')
    <div class="main-card mb-3 card">
        <div class="card-body">
            @include('layouts.inc.success')
            {{ $objects->links() }}
            {{-- {{ dd($objects) }} --}}
            <table style="width: 100%;" id="" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Supplier</th>
                        <th>Quotation No</th>
                        <th>Date <br>
                        Required Date</th>
                        <th>PO No</th>
                        <th>Country Name</th>
                        <th>Remarks</th>
                        <th>Print</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($objects ?? [] as $object)
                    <tr>
                        
                        <td>{{ $object->id ?? '' }}</td>
                        <td>{{ $object->supplier->name?? '' }}</td>
                        <td>{{ $object->quote_number ?? '' }}</td>
                        <td>{{ $object->date ?? '' }} <br>
                        {{ $object->required_date ?? '' }}
                        </td>
                        <td>{{ $object->id ?? '' }}</td>
                        <td>{{ $object->country->name ?? '' }}</td>
                        <td>{{ $object->remarks ?? '' }}</td>
                        <td>
                        
                            <a href="{{ route($route_name .'print', $object)   }}" class="btn  btn-icon btn-primary btn-sm"
                                href="#" role="button">
                                <i class="pe-7s-print btn-icon-wrapper"> </i>
                                Print</a>
                        </td>
                        <td>
                            <a href="{{ route($route_name .'show', $object)   }}" class="btn  btn-icon btn-warning btn-sm"
                                href="#" role="button">
                                <i class="pe-7s-note btn-icon-wrapper"> </i>
                                Edit</a>
                        </td>
                        <td>
                            <form class="delete" action="{{ route($route_name .'destroy', $object)  }}" method="POST">
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
                        <td colspan="9">
                            No Data...
                        </td>
                    </tr>
                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Supplier</th>
                        <th>Quotation No</th>
                        <th>Date <br>
                        Required Date</th>
                        <th>PO No</th>
                        <th>Country Name</th>
                        <th>Remarks</th>
                        <th>Print</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
            {{ $objects->links() }}
        </div>
    </div>
</div>

@endsection


@if ($search ?? '')
@section('search')
@includeWhen($search ?? '', 'spare.po.search')
@endsection
@endif