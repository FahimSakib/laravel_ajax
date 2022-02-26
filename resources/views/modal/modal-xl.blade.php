<div class="modal" tabindex="-1" role="dialog" id="saveDataModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <x-textbox col="col-md-6" required="required" labelName="Name" name="name"
                            placeholder="Enter your name" />
                        <x-textbox col="col-md-6" type="email" required="required" labelName="Email" name="email"
                            placeholder="Enter your email" />
                        <x-selectbox col="col-md-6" required="required" labelName="Role" name="role_id">
                            @if ($roles)
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                            @endif
                        </x-selectbox>
                        <x-selectbox col="col-md-6" required="required" labelName="District" name="district_id" onchange="upazilaList(this.value)">
                            @if ($districts)
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->location_name }}</option>
                            @endforeach
                            @endif
                        </x-selectbox>
                        <x-selectbox col="col-md-6" required="required" labelName="Upazila" name="upazila_id" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modalBtn"></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
