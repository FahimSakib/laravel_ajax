@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Users List
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" onclick="showModal('Add New User','Save')"
                                type="button">Add New</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-dark">
                        <thead>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Disctrict</th>
                            <th>Upazila</th>
                            <th>Postal Code</th>
                            <th>Verified Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@include('modal.modal-xl')
@endsection

@push('style')
<style>
    .required label:first-child::after {
        content: "* ";
        color: red;
        font-weight: bold;
    }
</style>
@endpush

@push('script')
<script >

    let _token = "{{ csrf_token() }}";

    function showModal(title, save) {
        $("#saveDataModal").modal('toggle', {
            keyboard: false,
            backdrop: 'static',
        });
        $("#saveDataModal .modal-title").text(title);
        $("#saveDataModal #save-btn").text(save);
    };

    $(document).on('click', '#save-btn', function () {
        let storeForm = document.getElementById('storeForm');
        let formData = new FormData(storeForm);
        store_form_data(formData);
    });

    function store_form_data(formData) {
        $.ajax({
            url:"{{ route('user.store') }}",
            type:"POST",
            data:formData,
            dataType:"JSON",
            contentType:false,
            processData:false,
            cache:false,
            success:function (data) {
                $('#storeForm').find('.is-invalid').removeClass('is-invalid');
                $('#storeForm').find('.error').remove();
               $.each(data.errors, function(key,value){
                   $('#storeForm #'+key).addClass('is-invalid');
                   $('#storeForm #'+key).parent().append('<div class="alert alert-danger mt-1 error">'+value+'</div>');
               });
            },
            error:function (xhr, ajaxOption, thrownError) {
                console.log(thrownError+'\r\n'+xhr.statusText+'\r\n'+xhr.responseText);
            }
        });
    }

    function upazilaList(district_id) {
        if (district_id) {
            $.ajax({
                url: "{{ route('upazila.list') }}",
                type: "POST",
                data: {
                    district_id: district_id,
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {
                    $('#upazila_id').html(''),
                        $('#upazila_id').html(data)
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError+'\r\n'+xhr.statusText+'\r\n'+xhr.responseText);
                }
            });
        };
    };

</script>
@endpush
