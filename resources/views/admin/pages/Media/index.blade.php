@extends('admin.app')

@section('title', 'Admin | Orcas')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Media</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-end">
                        <a href="#" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#addMedia"><i
                                class="bi bi-plus-circle"></i><span class="text-capitalize ms-1">Tambah</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="1-tab"
                                    data-bs-toggle="tab" data-bs-target="#media_1" type="button"
                                    role="tab">Banner</button>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="media_1" role="tabpanel">
                                <div class="table-responsive p-0">
                                    <x-admin.table id="banner">
                                        @slot('header')
                                            <tr>
                                                <x-admin.th>No</x-admin.th>
                                                <x-admin.th>Gambar</x-admin.th>
                                                <x-admin.th>Action</x-admin.th>
                                            </tr>
                                        @endslot
                                        @foreach ($banners as $item)
                                            <tr>
                                                <x-admin.td class="text-center">{{ $loop->iteration ?? '-' }}</x-admin.td>
                                                <x-admin.td class="text-center">
                                                    <img src="{{ asset('dist/assets/img/Medias/' . $item->img) }}"
                                                        alt="{{ $item->title }}" style="max-width: 200px; height: 150px"
                                                        class="img-thumbnail">
                                                </x-admin.td>
                                                <x-admin.td class="text-center">
                                                    <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                                        data-bs-target="#editBanner{{ $item->id }}"><i
                                                            class="bi bi-pencil-fill"></i><span
                                                            class="text-capitalize ms-1">Ubah</span></a>
                                                    <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                        data-bs-target="#hapusBanner{{ $item->id }}"><i
                                                            class="bi bi-trash-fill"></i><span
                                                            class="text-capitalize ms-1">Hapus</span></a>
                                                </x-admin.td>

                                                <!-- Modal Ubah Gambar Banner -->
                                                <div class="modal fade" id="editBanner{{ $item->id }}" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBannerLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="editBannerLabel">Ubah Gambar Banner
                                                                    {{ $item->title }}</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <form id="editBannerForm"
                                                                action="{{ route('media.update', $item->id) }}" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="formFile" class="form-label">Gambar Sebelumnya</label>
                                                                        <p class="text-center">
                                                                            <img src="{{ asset('dist/assets/img/Medias/' . $item->img) }}"
                                                                                alt="{{ $item->title }}"
                                                                                style="max-width: 200px; height: 150px"
                                                                                class="img-thumbnail">
                                                                        </p>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="formFile" class="form-label">Gambar Baru</label>
                                                                        <input class="form-control" type="file" id="formFile"
                                                                            name="img">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success">Ubah</button>
                                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Hapus Banner -->
                                                <div class="modal fade" id="hapusBanner{{ $item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="hapusBannerLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="hapusBannerLabel">Hapus Gambar Banner
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                                                    class="img-fluid w-25">
                                                                <p>Are you sure?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{ route('media.destroy', $item->id) }}" type="submit"
                                                                    class="btn btn-sm btn-danger">Hapus</a>
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
        </div>
    </div>

    <!-- Modal Tambah Gambar -->
    <div class="modal fade" id="addMedia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addMediaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addMediaLabel">Tambah Gambar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addMediaForm" action="{{ route('media.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Gambar</label>
                            <input class="form-control" type="file" id="formFile" name="img">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
