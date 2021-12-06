   <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Airtime info</h6>
                </div>
            </div>
            <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Id Airtime</label>
                                        <input type="number" value="{{ $Invoice->airtime_id }}" required
                                            name="airtime_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Start Periode</label>
                                        <input
                                            value="{{ $Invoice->airtime_start ? $Invoice->airtime_start->format('Y-m-d') : '---' }}"
                                            type="date" name="airtime_start" id="airtime_start" class="form-control"
                                            placeholder="Mulai Periode">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">End Periode</label>
                                        <input type="date" name="airtime_end"
                                            value="{{ $Invoice->airtime_end ? $Invoice->airtime_end->format('Y-m-d') : '---' }}"
                                            id="airtime_end" id="airtime_end" class="form-control"
                                            placeholder="Mulai Periode">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
