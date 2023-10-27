@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content">

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Admin</a></li>
                        <li class="breadcrumb-item active">Edit Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">

        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">
                    
                        <!-- end about me section content -->

                        <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        <form method="post" id="myForm" action="{{ route('admin-update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$adminUser->id}}">
            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Admin</h5>
    <div class="row">
        <div class="form-group col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $adminUser->name }}" class="form-control" >

            </div>
        </div>
        
        <div class="form-group col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Email</label>
                <input type="email" name="email" value="{{ $adminUser->email }}" class="form-control" >

            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $adminUser->phone }}" class="form-control" >

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="firstname" class="form-label">Asign Role</label>
        <select name="roles" class="form-select" id="example-select">
                <option selected disabled>Select Roles</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $adminUser->hasRole($role->name) ? 'selected' : ''}}>
                    {{ $role->name}}</option>
                @endforeach
            </select>

            </div>

            </div>
        </div> 

            </div> <!-- end row -->

        
    <div class="text-end">
        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
    </div>
        </form>
    </div>
                        <!-- end settings content-->
                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->
    </div>
    <!-- end row-->

</div> <!-- container -->

</div> 

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                email: {
                    required : true,
                },
                phone: {
                    required : true,
                },
                photo: {
                    required : true,
                },
                password: {
                    required : true,
                },
                roles: {
                    required : true,
                },
            },

            messages :{
                name: {
                    required : 'Please Enter User Name',
                },
                email: {
                    required : 'Please User Email',
                },
                phone: {
                    required : 'Please Enter User Phone',
                },
                photo: {
                    required : 'Please Enter User Photo',
                },
                password: {
                    required : 'Please Enter User Password',
                },
                roles: {
                    required : 'Please Select User Role',
                },

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>


@endsection 