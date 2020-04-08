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
                        <th>Name,Address</th>
                        <th>Email</th>   
                        <th>F-M-F</th>                    
                        <th>CA</th>
                        
                        <th>Spare </th>
                        <th>Machinery</th>
                        <th>Service </th>                                            
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
                        <td>{{ $object->name }} <br>{{ $object->address }}</td>
                        <td>{{ $object->email }}</td>
                        <td>
                            {{ $object->fixed_line }} ,
                            {{ $object->mobile }} ,
                            {{ $object->fax }} ,
                        </td>
                        <td>{!!$object->credit == 1 ? '<i class="fa fa-check fa-w-20 red"></i>': '' !!}</td>
                      
                        <td>C- {{ $object->spare }}
                            <br>D- {{ $object->discount_spare  }}
                        </td>
                        <td>C- {{ $object->machinery }}
                            <br>D- {{ $object->discount_machinery  }}
                        </td>
                        <td>C- {{ $object->service }}
                            <br>D- {{ $object->discount_service  }}
                        </td>
                       
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
                        <th>Name,Address</th>
                        <th>Email</th>   
                        <th>F-M-F</th>                    
                        <th>CA</th>
                       
                        <th>C-Spare </th>
                        <th>C-Machinery</th>
                        <th>C-Spare </th>                                            
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
@includeWhen($search ?? '', 'admin.customer.search')
@endsection
@endif