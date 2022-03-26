<div class="col-md-12">
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
    </tbody>
    </table>
</div>
