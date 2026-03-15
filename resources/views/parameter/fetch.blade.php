@if($action == 'create')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Parameter</h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><button id="close_btn" type="button" class="btn btn-icon btn-flat-danger"><i class="feather icon-x"></i></button></li>
            </ul>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form id="form" method="post">
                <div class="row">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Cerobong</label>
                            <select id="cerobong_id" class="form-control select2" name="cerobong_id" data-placeholder="Cerobong" required="required">
                                <option></option>
                                @foreach($cerobongs as $cerobong)
                                    <option value="{{ $cerobong->cerobong_id }}">{{ $cerobong->cerobong_name }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Kode Parameter</label>
                            <input id="parameter_code" type="text" class="form-control" name="parameter_code" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Nama Parameter</label>
                            <input id="parameter_name" type="text" class="form-control" name="parameter_name" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Baku Mutu</label>
                            <input id="parameter_threshold" type="text" class="form-control" name="parameter_threshold" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Satuan</label>
                            <input id="parameter_portion" type="text" class="form-control" name="parameter_portion" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Warna</label>
                            <input id="parameter_color" type="color" class="form-control" name="parameter_color" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Status</label>
                            <select id="parameter_status" class="form-control select2" name="parameter_status" data-placeholder="Status" required="required">
                                <option></option>
                                <option value="active">ACTIVE</option>
                                <option value="inactive">INACTIVE</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>ID SISPEK</label>
                            <input id="parameter_sispek" type="text" class="form-control" name="parameter_sispek" autocomplete="off">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <input id="action" type="hidden" name="action" value="{{ $action }}">
                        <button id="submit_btn" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if($action == 'update')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Ubah Parameter</h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><button id="close_btn" type="button" class="btn btn-icon btn-flat-danger"><i class="feather icon-x"></i></button></li>
            </ul>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form id="form" method="post">
                <div class="row">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Cerobong</label>
                            <select id="cerobong_id" class="form-control select2" name="cerobong_id" data-placeholder="Cerobong" required="required">
                                <option></option>
                                @foreach($cerobongs as $cerobong)
                                    <option value="{{ $cerobong->cerobong_id }}" {{ $parameter->cerobong_id == $cerobong->cerobong_id ? 'selected' : '' }}>{{ $cerobong->cerobong_name }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Kode Parameter</label>
                            <input id="parameter_code" type="text" class="form-control" name="parameter_code" autocomplete="off" required="required" value="{{ $parameter->parameter_code }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Nama Parameter</label>
                            <input id="parameter_name" type="text" class="form-control" name="parameter_name" autocomplete="off" required="required" value="{{ $parameter->parameter_name }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Baku Mutu</label>
                            <input id="parameter_threshold" type="text" class="form-control" name="parameter_threshold" autocomplete="off" required="required" value="{{ $parameter->parameter_threshold }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Satuan</label>
                            <input id="parameter_portion" type="text" class="form-control" name="parameter_portion" autocomplete="off" required="required" value="{{ $parameter->parameter_portion }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Warna</label>
                            <input id="parameter_color" type="color" class="form-control" name="parameter_color" autocomplete="off" required="required" value="{{ $parameter->parameter_color }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Status</label>
                            <select id="parameter_status" class="form-control select2" name="parameter_status" data-placeholder="Status" required="required">
                                <option></option>
                                <option value="active" {{ $parameter->parameter_status == 'active' ? 'selected' : '' }}>ACTIVE</option>
                                <option value="inactive" {{ $parameter->parameter_status == 'inactive' ? 'selected' : '' }}>INACTIVE</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>ID SISPEK</label>
                            <input id="parameter_sispek" type="text" class="form-control" name="parameter_sispek" autocomplete="off" value="{{ $parameter->parameter_sispek }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <input id="id" type="hidden" name="id" value="{{ $id }}">
                        <input id="action" type="hidden" name="action" value="{{ $action }}">
                        <button id="submit_btn" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if($action == 'delete')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Hapus Parameter</h4>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><button id="close_btn" type="button" class="btn btn-icon btn-flat-danger"><i class="feather icon-x"></i></button></li>
            </ul>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form id="form" method="post">
                <div class="row">
                    <div class="col-12">
                        <p>Apakah Anda yakin akan menghapus parameter <strong>{{ $parameter->parameter_name }}</strong> dari database?
                    </div>
                    <div class="col-12">
                        <input id="id" type="hidden" name="id" value="{{ $id }}">
                        <input id="action" type="hidden" name="action" value="{{ $action }}">
                        <button id="submit_btn" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
