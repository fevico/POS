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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Employee</a></li>
                        <li class="breadcrumb-item active">Edit Employee</li>
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
        <form method="post" action="{{ route('employee-update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $employee->id }}">
            
            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Employee</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Employee Name</label>
                <input type="text" name="name" value="{{ $employee->name }}" class="form-control @error('name') is-invalid @enderror" >
    @error('name')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Employee Email</label>
                <input type="email" name="email" value="{{ $employee->email }}" class="form-control @error('email') is-invalid @enderror" >
    @error('email')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div><!-- end col -->

        <div class="col-md-6">
            <div class="mb-3">
            <label for="firstname" class="form-label">Employee Phone</label>
        <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control @error('phone') is-invalid @enderror" >
    @error('phone')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div><!-- end col -->

        
        <div class="col-md-6">
            <div class="mb-3">
        <label for="firstname" class="form-label">Employee Address</label>
        <input type="text" name="address" value="{{ $employee->address }}" class="form-control @error('address') is-invalid @enderror" >
    @error('address')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        
    <div class="col-md-6">
    <div class="mb-3">
    <label for="firstname" class="form-label">Employee Experience</label>
    <select name="experience" class="form-select @error('experience') is-invalid @enderror" id="example-select">
             <option selected>Selecr Here</option>
                <option selected disabled>Select Year</option>
                <option value="1 Year" {{ $employee->experience == '1 Year' ? 'selected' : '' }}>1 Year</option>
                <option value="2 Year" {{ $employee->experience == '2 Year' ? 'selected' : '' }}>2 Year</option>
                <option value="3 Year" {{ $employee->experience == '3 Year' ? 'selected' : '' }}>3 Year</option>
                <option value="4 Year" {{ $employee->experience == '4 Year' ? 'selected' : '' }}>4 Year</option>
                <option value="5 Year" {{ $employee->experience == '5 Year' ? 'selected' : '' }}>5 Year</option>
            </select>
    @error('experience')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
               </div>
        </div>
  
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Employee Salary</label>
        <input type="text" name="salary" value="{{ $employee->salary }}" class="form-control @error('salary') is-invalid @enderror" >
    @error('salary')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Employee Vacation</label>
        <input type="text" name="vacation" value="{{ $employee->vacation }}" class="form-control @error('vacation') is-invalid @enderror" >
    @error('vacation')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Employee City</label>
        <input type="text" name="city" value="{{ $employee->city }}" class="form-control @error('salary') is-invalid @enderror" >
    @error('city')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="example-fileinput" class="form-label">Employee Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
                </div>
                    </div>

                    
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="example-fileinput" class="form-label"></label>
                    <img id="showImage" src="{{ asset($employee->image) }}" class="rounded-circle avatar-lg img-thumbnail"
                    alt="profile-image">
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
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection 