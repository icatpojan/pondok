<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="1">Name</label>
                        <input required value="{{ old('name') }}" type="text" class="form-control" id="1"
                            name="name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="2">Address</label>
                        <input required type="text" value="{{ old('address') }}" class="form-control" id="2"
                            name="address">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="3">Type</label>
                        <select name="type" class="form-control" id="3">
                            <option value="fishing">fishing</option>
                            <option value="oil and gas">oil and gas</option>
                            <option value="mining">mining</option>
                            <option value="cemercial transportation">cemercial transportation</option>
                            <option value="cargo">cargo</option>
                            <option value="goverment">goverment</option>
                        </select>
                        @if ($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="4">Contact</label>
                        <input required type="number" value="{{ old('contact') }}" class="form-control" id="4"
                            name="contact">
                        @if ($errors->has('contact'))
                            <span class="text-danger">{{ $errors->first('contact') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="5">Fax</label>
                        <input required type="number" class="form-control" id="5" name="fax">
                        @if ($errors->has('fax'))
                            <span class="text-danger">{{ $errors->first('fax') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="6">Phone</label>
                        <input required type="number" value="{{ old('phone') }}" class="form-control" id="6"
                            name="phone">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="7">NPWP</label>
                        <input type="number" name="npwp" hidden>
                        <div class="row">
                            <div class="col">
                                <input required type="number" value="{{ old('npwp_1') }}" class="form-control npwp" id="npwp_1" pattern="[0-9]{2}" data-maxlength="2" placeholder="- -" required>
                            </div>
                            <div class="col">
                                <input required type="number" value="{{ old('npwp_2') }}" class="form-control npwp" id="npwp_2" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                            </div>
                            <div class="col">
                                <input required type="number" value="{{ old('npwp_3') }}" class="form-control npwp" id="npwp_3" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                            </div>
                            <div class="col">
                                <input required type="number" value="{{ old('npwp_4') }}" class="form-control npwp" id="npwp_4" pattern="[0-9]{1}" data-maxlength="1" placeholder="-" required>
                            </div>
                            <div class="col">
                                <input required type="number" value="{{ old('npwp_5') }}" class="form-control npwp" id="npwp_5" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                            </div>
                            <div class="col">
                                <input required type="number" value="{{ old('npwp_6') }}" class="form-control npwp" id="npwp_6" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                            </div>
                        </div>
                        @if ($errors->has('npwp'))
                            <span class="text-danger">{{ $errors->first('npwp') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="8">Email</label>
                        <input required type="email" value="{{ old('email') }}" class="form-control" id="8"
                            name="email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="province">province</label>
                        <select name="province_id" id="province" class="form-control">
                            <option value="">== Select Province ==</option>
                            @foreach ($Province as $province)
                                <option value="{{ $province->province_id }}">{{ $province->province_name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('province_id'))
                            <span class="text-danger">{{ $errors->first('province_id') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <select name="city_id" id="city" class="form-control">
                            <option value="">== Select City ==</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="region_id">Region</label>
                        <select name="region" id="region" class="form-control">
                            <option value="">== Select Region ==</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="12">Kode pos</label>
                        <input required type="number" value="{{ old('kode_pos') }}" class="form-control" id="12"
                            name="kode_pos">
                        @if ($errors->has('kode_pos'))
                            <span class="text-danger">{{ $errors->first('kode_pos') }}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
