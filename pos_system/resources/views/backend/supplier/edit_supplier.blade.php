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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Supplier</a></li>
                        <li class="breadcrumb-item active">Edit Supplier</li>
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
        <form method="post" action="{{ route('supplier-update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $supplier->id }}">
            
            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Supplier</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Supplier Name</label>
                <input type="text" name="name" value="{{ $supplier->name }}" class="form-control @error('name') is-invalid @enderror" >
    @error('name')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Supplier Email</label>
                <input type="email" name="email" value="{{ $supplier->email }}" class="form-control @error('email') is-invalid @enderror" >
    @error('email')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div><!-- end col -->

        <div class="col-md-6">
            <div class="mb-3">
            <label for="firstname" class="form-label">Supplier Phone</label>
        <input type="text" name="phone" value="{{ $supplier->phone }}" class="form-control @error('phone') is-invalid @enderror" >
    @error('phone')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div><!-- end col -->

        
        <div class="col-md-6">
            <div class="mb-3">
        <label for="firstname" class="form-label">Supplier Address</label>
        <input type="text" name="address" value="{{ $supplier->address }}" class="form-control @error('address') is-invalid @enderror" >
    @error('address')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
        <label for="firstname" class="form-label">Supplier ShopName</label>
        <input type="text" name="shopname" value="{{ $supplier->shopname }}" class="form-control @error('shopname') is-invalid @enderror" >
    @error('shopname')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        
    <div class="col-md-6">
    <div class="mb-3">
    <label for="firstname" class="form-label">Supplier Type</label>
    <select name="type" class="form-select @error('type') is-invalid @enderror" id="example-select">
             <option selected>Selecr Here</option>
                <option selected disabled>Select Type</option>
                <option value="Distributor" {{ $supplier->type == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                <option value="Wholesaler" {{ $supplier->type == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
            </select>
    @error('type')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
               </div>
        </div>

  
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Account Holder</label>
        <input type="text" name="account_holder" value="{{ $supplier->account_holder }}" class="form-control @error('account_holder') is-invalid @enderror" >
    @error('account_holder')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Account Number</label>
        <input type="text" name="account_number" value="{{ $supplier->account_number }}" class="form-control @error('account_number') is-invalid @enderror" >
    @error('account_number')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Bank Name</label>
        <input type="text" name="bank_name" value="{{ $supplier->bank_name }}" class="form-control @error('bank_name') is-invalid @enderror" >
    @error('bank_name')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

        
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Bank Branch</label>
        <input type="text" name="bank_branch" value="{{ $supplier->bank_branch }}" class="form-control @error('bank_branch') is-invalid @enderror" >
    @error('bank_branch')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>
        
<div class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Supplier City</label>
        <input type="text" name="city" value="{{ $supplier->city }}" class="form-control @error('city') is-invalid @enderror" >
    @error('city')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
            </div>
        </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="example-fileinput" class="form-label">Supplier Image</label>
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
                    <img id="showImage" src="{{ asset($supplier->image) }}" class="rounded-circle avatar-lg img-thumbnail"
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