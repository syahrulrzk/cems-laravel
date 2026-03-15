@if($action == 'update')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Ubah Status Maintenance - {{ $cerobong->cerobong_name }}</h4>
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
                    <div class="col-12 col-md-6">
                        <fieldset class="form-group">
                            <label>Status</label>
                            <select id="cerobong_status" class="form-control select2" name="cerobong_status" data-placeholder="Status" required="required">
                                <option></option>
                                <option value="Normal" {{ $cerobong->cerobong_status == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Maintenance" {{ $cerobong->cerobong_status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-md-6">
                        <fieldset class="form-group">
                            <label>Schedule</label>
                            <select id="cerobong_schedule" class="form-control select2" name="cerobong_schedule" data-placeholder="Schedule" required="required">
                                <option></option>
                                <option value="Normal" {{ $cerobong->cerobong_schedule == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Scheduled" {{ $cerobong->cerobong_schedule == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="Unscheduled" {{ $cerobong->cerobong_schedule == 'Unscheduled' ? 'selected' : '' }}>Unscheduled</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-md-6">
                        <fieldset class="form-group">
                            <label>From</label>
                            <input id="cerobong_from" type="text" class="form-control pickadate" name="cerobong_from" autocomplete="off" required="required" value="{{ $cerobong->cerobong_from }}">
                        </fieldset>
                    </div>
                    <div class="col-12 col-md-6">
                        <fieldset class="form-group">
                            <label>To</label>
                            <input id="cerobong_to" type="text" class="form-control pickadate" name="cerobong_to" autocomplete="off" required="required" value="{{ $cerobong->cerobong_to }}">
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
