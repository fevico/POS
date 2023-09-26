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
                        <li class="breadcrumb-item"><a href="{{ route('export') }}" 
                        class="btn btn-primary rounded-pill waves-effect waves-light">Dowload Xlsx</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Import Product</h4>
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
        <form method="post" id="myForm" action="{{ route('import') }}" enctype="multipart/form-data">
            @csrf
            
    <div class="row">
        <div class="form-group col-md-12">
            <div class="mb-3">
                <label for="firstname" class="form-label">Xlsx File Import</label>
                <input type="file" name="import_file" class="form-control" >

            </div>
        </div>
        
    <div class="text-end">
        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i>Upload</button>
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


@endsection 