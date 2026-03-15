@if($action == 'create')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah User</h4>
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
                            <label>Email</label>
                            <input id="user_email" type="email" class="form-control" name="user_email" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Password</label>
                            <input id="user_pass" type="password" class="form-control" name="user_pass" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Nama Lengkap</label>
                            <input id="user_full" type="text" class="form-control" name="user_full" autocomplete="off" required="required">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Hak Akses</label>
                            <select id="user_role" class="form-control select2" name="user_role" data-placeholder="Hak Akses" required="required">
                                <option></option>
                                <option value="Admin">Admin</option>
                                <option value="Engineer">Engineer</option>
                                <option value="Operator">Operator</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Terima Notif</label>
                            <select id="user_notif" class="form-control select2" name="user_notif" data-placeholder="Terima Notif" required="required">
                                <option></option>
                                <option value="0">TIDAK</option>
                                <option value="1">YA</option>
                            </select>
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
        <h4 class="card-title">Ubah User</h4>
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
                            <label>Email</label>
                            <input id="user_email" type="email" class="form-control" name="user_email" autocomplete="off" required="required" value="{{ $user->email }}" readonly>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Nama Lengkap</label>
                            <input id="user_full" type="text" class="form-control" name="user_full" autocomplete="off" required="required" value="{{ $user->name }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Hak Akses</label>
                            <select id="user_role" class="form-control select2" name="user_role" data-placeholder="Hak Akses" required="required">
                                <option></option>
                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Engineer" {{ $user->role == 'Engineer' ? 'selected' : '' }}>Engineer</option>
                                <option value="Operator" {{ $user->role == 'Operator' ? 'selected' : '' }}>Operator</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Terima Notif</label>
                            <select id="user_notif" class="form-control select2" name="user_notif" data-placeholder="Terima Notif" required="required">
                                <option></option>
                                <option value="0" {{ $user->notif == 0 ? 'selected' : '' }}>TIDAK</option>
                                <option value="1" {{ $user->notif == 1 ? 'selected' : '' }}>YA</option>
                            </select>
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
        <h4 class="card-title">Hapus User</h4>
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
                        <p>Apakah Anda yakin akan menghapus <strong>{{ $user->name }}</strong> dari database?
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

@if($action == 'password')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Ubah Password</h4>
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
                            <label>Email</label>
                            <input id="user_email" type="email" class="form-control" name="user_email" autocomplete="off" required="required" value="{{ $user->email }}" readonly>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Password Baru</label>
                            <input id="user_pass" type="password" class="form-control" name="user_pass" autocomplete="off" required="required">
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
