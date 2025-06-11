@extends('admin.app')

@section('title', 'Admin | Orcas')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>News</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-end">
                        <a href="{{ route('news.create') }}" class="btn bg-gradient-success"><i
                                class="bi bi-plus-circle"></i><span class="text-capitalize ms-1">Tambah</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Judul</x-admin.th>
                                        <x-admin.th>Photo</x-admin.th>
                                        <x-admin.th>Deskripsi</x-admin.th>
                                        <x-admin.th>Published Date</x-admin.th>
                                        <x-admin.th>Author</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot
                                @foreach ($data as $item)
                                    <tr>
                                        <x-admin.td class="text-center">{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td class="text-center">{{ $item->title ?? '-' }}</x-admin.td>
                                        <x-admin.td class="text-center">
                                            @foreach (explode(',', $item->img) as $listImage)
                                                <p class="text-xs desc">
                                                    <a href="{{ asset('dist/assets/img/News/' . trim($listImage)) }}"
                                                        target="_blank">
                                                        {{ trim($listImage) }}
                                                    </a>
                                                </p>
                                            @endforeach
                                        </x-admin.td>
                                        <x-admin.td maxWidth="300px">{!! $item->desc ?? '' !!}</x-admin.td>  
                                        <x-admin.td maxWidth="300px">{{ $item->publish_date ?? '-' }}</x-admin.td>
                                        <x-admin.td class="text-center">{{ $item->author ?? '-' }}</x-admin.td>
                                        <x-admin.td class="text-center">
                                            <a href="{{ route('news.edit', $item->id) }}" class="btn bg-gradient-info"><i
                                                    class="bi bi-pencil-fill"></i><span
                                                    class="text-capitalize ms-1">Ubah</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusProject{{ $item->id }}"><i class="bi bi-trash-fill"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Hapus Project -->
                                        <div class="modal fade" id="hapusProject{{ $item->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusProjectLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusProjectLabel">Hapus Data Store
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                                            class="img-fluid w-25">
                                                        <p>Apakah anda yakin?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('news.destroy', $item->id) }}"
                                                            type="submit" class="btn btn-sm btn-danger">Hapus</a>
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </x-admin.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
