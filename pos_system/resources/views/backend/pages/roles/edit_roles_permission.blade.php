@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style type="text/css">
    .form-check-label{
        text-transform: capitalize;
    }
</style>

<div class="content">

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Role In Permission</a></li>
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
        <form method="post" id="myForm" action="{{ route('role-permission-update',$role->id) }}" >
            @csrf
            <input type="hidden" name="id" value="{{ $role->id }}">
            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Role In Permission</h5>
    <div class="row">


    <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="firstname" class="form-label"> Role Name</label>
    <h3>{{ $role->name }}</h3>
            </div>
        </div> 

    <div class="form-check mb-2 form-check-primary">
        <input class="form-check-input" type="checkbox" value="" id="customckeck15" >
        <label class="form-check-label" for="customckeck15">Select All</label>
    </div>

    <hr>
    @foreach($permission_gruop as $group)
    <div class="row"> 
        <div class="col-3">
            @php 
            $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
            @endphp 

        <div class="form-check mb-2 form-check-primary">
        <input class="form-check-input" type="checkbox" value="" id="customckeck1" 
        {{ App\Models\User::roleHasPermission($role,$permissions) ? 'checked' : ''}} >
        <label class="form-check-label" for="customckeck1">{{ $group->group_name }}</label>
    </div>

        </div>

        <div class="col-9">
  

        @foreach($permissions as $permission)
        <div class="form-check mb-2 form-check-primary">
        <input class="form-check-input" type="checkbox"{{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} 
        name="permission[]" value="{{ $permission->id }}" id="customckeck{{ $permission->id }}" >
        <label class="form-check-label" for="customckeck{{ $permission->id }}">{{ $permission->name }}</label>
    </div>
    @endforeach
    <br>

        </div>
    </div>
    @endforeach
    </div>
        
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
    $('#customckeck15').click(function(){
        if ($(this).is(':checked')){
            $('input[type = checkbox]').prop('checked',true);
        }else{
        $('input[type = checkbox]').prop('checked',false);   
        }
    })

</script>

@endsection 