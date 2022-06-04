@extends('backend.admin.hr-master')

@section('title')

@endsection

@section('content')
<div class="page-content">
    <div class="">
        <!--Admission debit and credit calculation-->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
            <div class="col">
                <div class="card radius-10" style="background-color: #0bb2d3">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Admission Advance</p>
                        <h3 class="mb-3 text-white">
                            {{ number_format($todayCredit,2 ?? 0) }}
                        </h3>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: darkred">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($todayDue,2 ?? 0) }}</h3>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($monthlyDebit,2 ?? 0) }}</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: deepskyblue">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Due Collect</p>
                        <h3 class="mb-3 text-white">{{ number_format($monthlyDueCollect,2 ?? 0) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Due Collect</p>
                        <h3 class="mb-3 text-white">{{ number_format($todayDueCollect, 2) }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: lightskyblue">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereDate('created_at', \Carbon\Carbon::today())->get()->sum('price'),2) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: darkseagreen">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereMonth('created_at', date('m'))->get()->sum('price'),2) }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search-form-wrapper card p-4">
        <div class="container">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <form class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="employe_name" style="font-weight: 600; margin-bottom: 5px;">
                                    Employe Name
                                </label><br>
                                <select name="employe_name" class="form-control">
                                    <option selected disabled>--- Select Employee Name ---</option>
                                    <option class="al amin saki">Al-Amin</option>
                                    <option class="rakib">Rakib</option>
                                    <option class="rony">Rony</option>
                                    <option class="limon">Limon</option>
                                    <option class="utso">Utso</option>
                                    <option class="forid">Forid</option>
                                    <option class="shibly">Shibly</option>
                                    <option class="masum">Masum</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date" style="font-weight: 600; margin-bottom: 5px;">
                                    Date
                                </label><br>
                                <input type="date" name="date" class="form-control" placeholder="Date">
                            </div>
                            <div class="col-md-3">
                                <div class="input-group" style="margin-top: 25px;">
                                    <button type="submit" class="input-group-text btn btn-primary">Search</button>
                                    <a href="#" class="input-group-text btn btn-danger">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>batch</th>
                            <th>Studenrt Name</th>                            
                            <th>Student Phone</th>
                            <th>Student Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
{{--    <script>--}}
{{--        setInterval(function() {--}}
{{--            window.location.reload();--}}
{{--        }, 10000);--}}
{{--    </script>--}}
@endpush
