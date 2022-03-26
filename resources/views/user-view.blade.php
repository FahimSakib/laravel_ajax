<div class="col-md-8">
    <table class="table-borderless">
        <thead>
            <th class="col-md-6">Filed</th>
            <th class="col-md-6">Details</th>
        </thead>
        <tbody>
        <tr>
            <td><b>Name</b> </td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td><b>Role</b> </td>
            <td>{{ $user->role->role_name }}</td>
        </tr>
        <tr>
            <td><b>Email</b> </td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td><b>Mobile</b> </td>
            <td>{{ $user->mobile_no }}</td>
        </tr>
        <tr>
            <td><b>District</b> </td>
            <td>{{ $user->district->location_name }}</td>
        </tr>
        <tr>
            <td><b>Upazila</b> </td>
            <td>{{ $user->upazila->location_name }}</td>
        </tr>
        <tr>
            <td><b>Postal Code</b> </td>
            <td>{{ $user->postal_code }}</td>
        </tr>
        <tr>
            <td><b>Address</b> </td>
            <td>{{ $user->address }}</td>
        </tr>
        <tr>
            <td><b>Status</b> </td>
            <td>
                @if ($user->status == 1)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
        </tr>
        <tr>
            <td><b>Email Verification</b> </td>
            <td>
                @if ($user->email_verified_at != null)
                <span class="badge bg-success">Verified</span>
                @else
                <span class="badge bg-danger">Unverified</span>
                @endif
            </td>
        </tr>
        <tr>
            <td><b>Created At</b> </td>
            <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
            <td><b>Updated At</b> </td>
            <td>{{ $user->updated_at }}</td>
        </tr>
    </tbody>
    </table>
</div>
<div class="col-md-4">
    @if (!empty($user->avatar))
    <img src="{{ asset('storage/User/'.$user->avatar) }}" alt="{{ $user->name }}" style="width: 250px">
    @else
        <p>not found</p>
    @endif
</div>