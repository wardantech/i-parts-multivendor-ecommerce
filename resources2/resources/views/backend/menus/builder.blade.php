@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">Menus builder ({{ $menu->name }})</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">How to use:</h5>
                <p>You can output a menu anywhere on your site by calling <code>menu('name')</code></p>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-body menu-builder">
                <h5 class="card-title">Drag and drop the menu items belows to re-arrange them.</h5>
                <div class="dd">
                    <ol class="dd-list">
                        @forelse ($menu->categories as $item)
                            <li class="dd-item" data-id="{{ $item->id }}">

                                {{-- <div class="pull-right item_actions">
                                    <a href="" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $item->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('app.menus.item.destroy', ['id'=>$menu->id, 'itemId' => $item->id]) }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div> --}}

                                <div class="dd-handle">
                                    <span>{{ $item->name }}</span>
                                    {{-- <small class="url">{{ $item->url }}</small> --}}
                                </div>

                                @if (!$item->childs->isEmpty())
                                    <ol class="dd-list">
                                        @foreach ($item->childs as $childItem)
                                            <li class="dd-item" data-id="{{ $childItem->id }}">

                                                {{-- <div class="pull-right item_actions">
                                                    <a href="" class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                        <span>Edit</span>
                                                    </a>

                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $childItem->id }})">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <span>Delete</span>
                                                    </button>

                                                    <form id="delete-form-{{ $childItem->id }}" method="POST" action="{{ route('app.menus.item.destroy', ['id'=>$menu->id, 'itemId' => $childItem->id]) }}" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div> --}}

                                                <div class="dd-handle">
                                                    <span>{{ $childItem->name }}</span>
                                                    <small class="url">{{ $childItem->url }}</small>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                @endif

                            </li>
                        @empty
                            <div class="text-center">
                                <strong>No menu item found.</strong>
                            </div>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $('.dd').nestable({maxDepth: 2});
    $('.dd').on('change', function(e) {
        $.post('{{ route('menus.item.order', $menu->id) }}', {
            order:JSON.stringify($('.dd').nestable('serialize')),
            _token: '{{ csrf_token() }}'
        }, function(data) {
            // iziToast.success({
            //     title: 'Success',
            //     message: 'Successfully update menu order',
            // });
            console.log('Success');
        });
    });
</script>
@endsection
