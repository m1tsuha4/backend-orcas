@extends('admin.app')

@section('title', 'Admin | Basko Grand Mall')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Tambah News</h6>
                <div class="card mb-4">
                    <div class="card-body px-5 py-2">
                         <form id="addProjectForm" action="{{ route('news.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col col-12">
                                        <x-admin.input type="text" placeholder="Judul" label="Judul" name="title" />
                                    </div>
                                    <div class="col col-6">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Photo</label>
                                            <input class="form-control" type="file" id="formFile" name="img[]" multiple>
                                        </div>
                                    </div>
                                    <div class="col col-6">
                                        <x-admin.input type="datetime-local" placeholder="Published Date" label="Published Date" name="publish_date" />
                                    </div
                                    <div class="col col-12">
                                        <x-admin.input type="text" placeholder="Author" label="Author" name="author" />
                                    </div>
                                    <div class="col col-12">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control mb-3" name="desc" cols="10" rows="5" id="deskripsi"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-sm btn-success">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
