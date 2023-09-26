@extends('admin_dashboard')
@section('admin')

<div class="content">

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    <a href="{{ route('add-expense') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Expense</a>

                    </ol>
                </div>
                <h4 class="page-title">Year Expense</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @php 
    $year = date('Y');
    $expense = App\Models\Expense::where('year',$year)->sum('ammount');
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <h4 class="header-title">Year Expense</h4>
                <h4 style="color:white; font-size:30px;" align="center">Total : ${{$expense}}</h4>

            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Details</th>
                        <th>Ammount</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Date</th>
                    </tr>
                </thead>

    <tbody>
        @foreach($YearExpense as $key=> $item)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $item->details }}</td>
            <td>{{ $item->ammount }}</td>
            <td>{{ $item->mounth }}</td>
            <td>{{ $item->year }}</td>
            <td>{{ $item->date }}</td>
            
        </tr>
        @endforeach
        </tbody>
            </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

    <!-- end row-->
    
</div> <!-- container -->

</div>

@endsection 