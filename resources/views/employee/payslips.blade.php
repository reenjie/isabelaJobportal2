@extends('layouts.homeLayout', ['pageTitle' => 'Payslips', 'active' => 'payslips'])

@section('content')
    <div class="container-fluid">

        @if(count($data)>=1)
        @foreach ($data as $item)
            <div class="card shadow mb-2 text-center">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-3">
                            <table class="table table-striped table-sm table-bordered">
                                <tr>
                                    <th colspan="2">
                                        <h6 class="fw-bold">PERA : {{ $item->PERA }}</h6>
                                    </th>
                                </tr>

                                <tr>
                                    <td>
                                        Monthly Sal
                                    </td>
                                    <td>
                                        &#8369; {{ number_format($item->monthly_sal) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tax
                                    </td>
                                    <td>
                                        {{ $item->wtax }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        GSIS
                                    </td>
                                    <td>
                                        {{ $item->gsis_ps }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        GSIS Cal
                                    </td>
                                    <td>
                                        {{ $item->gsis_ca }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        GSIS Pol
                                    </td>
                                    <td>
                                        {{ $item->gsis_policy_loan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        GSIS H
                                    </td>
                                    <td>
                                        {{ $item->gsis_housing }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        CONSO
                                    </td>
                                    <td>
                                        {{ $item->gsis_conso_loan }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-3">
                            <table class="table table-striped table-sm table-bordered">
                                <tr>
                                    <th colspan="2">
                                        <h6 class="fw-bold">ADCOM : {{ $item->ADCOM }}</h6>
                                    </th>
                                </tr>

                                <tr>
                                    <td>
                                        EducL
                                    </td>
                                    <td>
                                        {{ $item->gsis_edu_loan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Opt-Pol
                                    </td>
                                    <td>
                                        {{ $item->gsis_optpolicy }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        E-PLus
                                    </td>
                                    <td>
                                        {{ $item->gsis_eplus }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Optins
                                    </td>
                                    <td>
                                        {{ $item->gsis_optins }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pagibig
                                    </td>
                                    <td>
                                        {{ $item->hdmf_ps }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        HDMFCal
                                    </td>
                                    <td>
                                        {{ $item->hdmf_calamity_loan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        GSISEM
                                    </td>
                                    <td>
                                        {{ $item->gsis_calamity_loan }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-3">
                            <table class="table table-striped table-sm table-bordered">
                                <tr>
                                    <th colspan="2">
                                        <h6 class="fw-bold">ADCOM+ : {{ $item->RATA }}</h6>
                                    </th>
                                </tr>

                                <tr>
                                    <td>
                                        MPL
                                    </td>
                                    <td>
                                        {{ $item->hdmf_mpl }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Philhealt
                                    </td>
                                    <td>
                                        {{ $item->philhealth_ps }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        SSL
                                    </td>
                                    <td>
                                        {{ $item->ppsta }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        SSS
                                    </td>
                                    <td>
                                        {{ $item->zcspc_finance_loan }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        COOP
                                    </td>
                                    <td>
                                        {{ $item->zcspc_regular_loan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        COOP
                                    </td>
                                    <td>
                                        {{ $item->zcspc_finance_loan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        HDMF H
                                    </td>
                                    <td>
                                        {{ $item->hdmf_rlestate }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-3">
                            <table class="table table-striped table-sm table-bordered">
                                <tr>
                                    <th colspan="2">
                                        <h6 class="fw-bold">
                                            @php
                                                $payID = $item->payID;
                                                $filteredPayheader = array_filter($payheader, function ($p) use ($payID) {
                                                    return $p->payID == $payID;
                                                });
                                            @endphp
                                            @foreach ($filteredPayheader as $py)
                                                {{ $py->period }}
                                            @endforeach
                                        </h6>
                                    </th>
                                </tr>

                                <tr>
                                    <td>
                                        MPA P
                                    </td>
                                    <td>
                                        {{ $item->ONB_loan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        MPA L
                                    </td>
                                    <td>
                                        {{ $item->PNB_beneficial }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        LB Loa
                                    </td>
                                    <td>
                                        {{ $item->unionpay }}
                                    </td>
                                </tr>

                            </table>

                            <table class="table table-striped table-bordered fw-bold">

                                <tr>
                                    <td>
                                        DEDUCT
                                    </td>
                                    <td>
                                        @php
                                            $deductions = [];
                                            if ($item->zcspc_regular_loan >= 1) {
                                                $deductions[] = $item->zcspc_regular_loan;
                                            }
                                            
                                            if ($item->zcspc_finance_loan >= 1) {
                                                $deductions[] = $item->zcspc_finance_loan;
                                            }
                                            
                                            if ($item->hdmf_calamity_loan >= 1) {
                                                $deductions[] = $item->hdmf_calamity_loan;
                                            }
                                            if ($item->gsis_calamity_loan >= 1) {
                                                $deductions[] = $item->gsis_calamity_loan;
                                            }
                                            if ($item->gsis_policy_loan >= 1) {
                                                $deductions[] = $item->gsis_policy_loan;
                                            }
                                            if ($item->gsis_housing >= 1) {
                                                $deductions[] = $item->gsis_housing;
                                            }
                                            if ($item->gsis_edu_loan >= 1) {
                                                $deductions[] = $item->gsis_edu_loan;
                                            }
                                            if ($item->gsis_conso_loan >= 1) {
                                                $deductions[] = $item->gsis_conso_loan;
                                            }
                                            
                                            echo count($deductions);
                                        @endphp

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        GROSS
                                    </td>
                                    <td>
                                        &#8369; {{ $item->grosspay }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        NETPAY
                                    </td>
                                    <td>
                                        &#8369; {{ $item->netpay }}
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @else 
        <div style="text-align: center;pointer-events:none;user-select:none" class="mt-5">
            <img src="https://th.bing.com/th/id/OIP.mexosehXrciNRvS4NohrwAAAAA?pid=ImgDet&rs=1" alt="" style="margin-top:50px">
            <br> <br>
    
          <h5 style="color:gray">  No Payslips Found..</h5>
        </div>
    
        @endif
        @isset($links)
            @if (count($links) >= 1)
                {{ $links->render('admin.components.pagination') }}
            @endif
        @endisset
    </div>
@endsection
