<div class="modal" tabindex="-1" role="dialog" id="saveDataModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="storeForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-12">
                                <span>All the (*) marked fileds are required</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <x-textbox col="col-md-12" required="required" labelName="Name" name="name"
                                placeholder="Enter your name" />
                            <x-textbox col="col-md-12" type="email" required="required" labelName="Email" name="email"
                                placeholder="Enter your email" />
                            <x-textbox col="col-md-12" required="required" labelName="Mobile Number" name="mobile_no"
                                placeholder="Enter your mobile number" />
                            <x-textbox col="col-md-12" type="password" required="required" labelName="Password"
                                name="password" placeholder="Enter your password" />
                            <x-textbox col="col-md-12" type="password" required="required" labelName="Confirm Password"
                                name="password_confirmation" placeholder="confirm your password" />
                            <x-selectbox col="col-md-12" required="required" labelName="District" name="district_id"
                                onchange="upazilaList(this.value)">
                                @if ($districts)
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->location_name }}</option>
                                @endforeach
                                @endif
                            </x-selectbox>
                            <x-selectbox col="col-md-12" required="required" labelName="Upazila" name="upazila_id" />
                            <x-textbox col="col-md-12" type="number" required="required" labelName="Postal Code"
                                name="postal_code" placeholder="Enter your postal code" />
                            <x-textarea col="col-md-12" required="required" labelName="Address" name="address"
                                placeholder="Enter your address" />
                        </div>
                        <div class="col-lg-4">
                            <x-selectbox col="col-md-12" required="required" labelName="Role" name="role_id">
                                @if ($roles)
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                                @endif
                            </x-selectbox>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save-btn"></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
