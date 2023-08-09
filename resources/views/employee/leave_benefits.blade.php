@extends('layouts.homeLayout',['pageTitle'=>"Terminal Leave Benefits","active"=>"leave_benefits"])

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <div class="card shadow mt-3 " style="font-size: 15px;">
                <div class="card-body">
                    <h6>As of {{date('l')}}, {{date('F j, Y')}} </h6>

                    <table class="table table-bordered table-sm mt-3 text-center shadow">
                        <thead>
                            <th class="table-secondary" colspan="2">Accumulated Leave Credits ( D )</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">Vacation</td>
                                <td>{{$D[0]->vacay_lv}}</td>

                            </tr>
                            <tr>
                                <td scope="row">Sick Leave</td>
                                <td>{{$D[0]->sick_lv}}</td>

                            </tr>
                            <tr>
                                <th scope="row">TOTAL</th>
                                <td>{{$D[0]->D}}</td>

                            </tr>


                        </tbody>
                    </table>

                    <table class="table table-bordered table-sm mt-3 text-center shadow">

                        <tbody>
                            <tr>
                                <td scope="row">Highest Monthly Salary (S)</td>
                                <td>&#8369; {{ number_format($maxSalary)}}</td>

                            </tr>
                            <tr>
                                <td scope="row">Constant Factor ( CF ) </td>
                                <td>{{$constantFactor}}</td>

                            </tr>



                        </tbody>
                    </table>

                    <table class="table table-bordered table-sm mt-3 text-center shadow">
                        <thead>
                            <th class="table-secondary" colspan="2">TLB = S x D x CF</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row" style="font-size: 20px;">{{round($terminalLeaveBenefits,2)}}</td>
                            </tr>



                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>
    @isset($links)
    @if (count($links) >= 1)
    {{ $links->render('admin.components.pagination') }}
    @endif
    @endisset
</div>
@endsection