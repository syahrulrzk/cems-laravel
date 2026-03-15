@if($action == 'create' || $action == 'update')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ $action == 'create' ? 'Tambah' : 'Ubah' }} Activity</h4>
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
                            <label>Title</label>
                            <input id="activity_title" type="text" class="form-control" name="activity_title" autocomplete="off" required="required" value="{{ $activity->activity_title ?? '' }}">
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Category</label>
                            <select id="activity_cat" class="form-control select2" name="activity_cat" data-placeholder="Category" required="required">
                                <option></option>
                                <option value="troubleshoot" {{ ($activity->activity_cat ?? '') == 'troubleshoot' ? 'selected' : '' }}>Troubleshoot</option>
                                <option value="service" {{ ($activity->activity_cat ?? '') == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="maintenance" {{ ($activity->activity_cat ?? '') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Description</label>
                            <textarea id="activity_desc" class="form-control" name="activity_desc" rows="3" required="required">{{ $activity->activity_desc ?? '' }}</textarea>
                        </fieldset>
                    </div>
                    <div class="col-12 col-md-6">
                        <fieldset class="form-group">
                            <label>From</label>
                            <input id="activity_from" type="text" class="form-control pickadate" name="activity_from" autocomplete="off" required="required" value="{{ $activity->activity_from ?? '' }}">
                        </fieldset>
                    </div>
                    <div class="col-12 col-md-6">
                        <fieldset class="form-group">
                            <label>To</label>
                            <input id="activity_to" type="text" class="form-control pickadate" name="activity_to" autocomplete="off" required="required" value="{{ $activity->activity_to ?? '' }}">
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
        <h4 class="card-title">Hapus Activity</h4>
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
                        <p>Apakah Anda yakin akan menghapus <strong>{{ $activity->activity_title }}</strong> dari database?
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
