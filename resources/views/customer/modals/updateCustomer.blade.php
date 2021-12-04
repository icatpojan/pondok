@foreach ($Customer as $customer)
    <div class="modal fade" id="updateModal-{{ $customer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="13">Name</label>
                            <input value="{{ old('name') ?? $customer->name }}" required type="text"
                                class="form-control" id="13" name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="14">Address</label>
                            <textarea id="14" rows="3" name="address"
                                class="form-control">{{ $customer->address }}</textarea>
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="15">Type</label>
                            <select name="type" class="form-control" id="3">
                                <option {{ $customer->type == 'fishing' ? 'selected' : '' }} value="fishing">fishing
                                </option>
                                <option {{ $customer->type == 'oil and gas' ? 'selected' : '' }} value="oil and gas">
                                    oil and gas</option>
                                <option {{ $customer->type == 'mining' ? 'selected' : '' }} value="mining">mining
                                </option>
                                <option {{ $customer->type == 'cemercial transportation' ? 'selected' : '' }}
                                    value="cemercial transportation">cemercial transportation</option>
                                <option {{ $customer->type == 'cargo' ? 'selected' : '' }} value="cargo">cargo
                                </option>
                                <option {{ $customer->type == 'goverment' ? 'selected' : '' }} value="goverment">
                                    goverment</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="16">Contact</label>
                            <input value="{{ $customer->contact }}" required type="number" class="form-control"
                                id="16" name="contact">
                            @if ($errors->has('contact'))
                                <span class="text-danger">{{ $errors->first('contact') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="17">Fax</label>
                            <input value="{{ $customer->fax }}" required type="number" class="form-control" id="17"
                                name="fax">
                            @if ($errors->has('fax'))
                                <span class="text-danger">{{ $errors->first('fax') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="18">Phone</label>
                            <input value="{{ $customer->phone }}" required type="number" class="form-control"
                                id="18" name="phone">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="19">NPWP</label>
                            <input value="{{ $customer->npwp }}" type="number" name="npwp" hidden>
                            <div class="row">
                                @if($npwp && $npwp[$customer->id])
                                    <div class="col">
                                        <input required type="number" value="{{ $npwp[$customer->id][0].$npwp[$customer->id][1] }}" class="form-control npwp_edit" id="npwp_edit_1" pattern="[0-9]{2}" data-maxlength="2" placeholder="- -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" value="{{ $npwp[$customer->id][2].$npwp[$customer->id][3].$npwp[$customer->id][4] }}" class="form-control npwp_edit" id="npwp_edit_2" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" value="{{ $npwp[$customer->id][5].$npwp[$customer->id][6].$npwp[$customer->id][7] }}" class="form-control npwp_edit" id="npwp_edit_3" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" value="{{ $npwp[$customer->id][8] }}" class="form-control npwp_edit" id="npwp_edit_4" pattern="[0-9]{1}" data-maxlength="1" placeholder="-" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" value="{{ $npwp[$customer->id][9].$npwp[$customer->id][10].$npwp[$customer->id][11] }}" class="form-control npwp_edit" id="npwp_edit_5" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" value="{{ $npwp[$customer->id][12].$npwp[$customer->id][13].$npwp[$customer->id][14] }}" class="form-control npwp_edit" id="npwp_edit_6" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                @else
                                    <div class="col">
                                        <input required type="number" class="form-control npwp_edit" id="npwp_edit_1" pattern="[0-9]{2}" data-maxlength="2" placeholder="- -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" class="form-control npwp_edit" id="npwp_edit_2" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" class="form-control npwp_edit" id="npwp_edit_3" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" class="form-control npwp_edit" id="npwp_edit_4" pattern="[0-9]{1}" data-maxlength="1" placeholder="-" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" class="form-control npwp_edit" id="npwp_edit_5" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                    <div class="col">
                                        <input required type="number" class="form-control npwp_edit" id="npwp_edit_6" pattern="[0-9]{3}" data-maxlength="3" placeholder="- - -" required>
                                    </div>
                                @endif
                            </div>
                            @if ($errors->has('npwp'))
                                <span class="text-danger">{{ $errors->first('npwp') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="20">Email</label>
                            <input value="{{ $customer->email }}" required type="text" class="form-control" id="20"
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
                            <label for="24">Kode pos</label>
                            <input value="{{ $customer->kode_pos }}" required type="text" class="form-control"
                                id="24" name="kode_pos">
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
@endforeach
