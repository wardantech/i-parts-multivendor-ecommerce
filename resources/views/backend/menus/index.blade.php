@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Menus</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('menus.create') }}" class="btn btn-primary">
                <span>Add New menu</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Menus</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $key => $menu)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            {{ $menu->name }}
                        </td>
                        <td>
                            {{ $menu->description }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('menus.builder', $menu->id) }}" class="btn btn-soft-success btn-icon btn-circle btn-sm" title="Builder">
                                <i class="las la-list-ul" style="font-size: 20px"></i>
                            </a>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('menus.edit', $menu->id) }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('menus.destroy', $menu->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')

@endsection
