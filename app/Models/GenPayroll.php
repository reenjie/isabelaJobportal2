<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenPayroll extends Model
{
    use HasFactory;

    protected $table = '_gen_payroll';
    protected $fillable = [
        'payID',
        'emp_ID',
        'monthly_sal',
        'PERA',
        'ADCOM',
        'RATA',
        'adjustment',
        'gsis_ps',
        'gsis_gs',
        'gsis_ca',
        'gsis_policy_loan',
        'gsis_calamity_loan',
        'gsis_conso_loan',
        'gsis_eplus',
        'gsis_edu_loan',
        'gsis_housing',
        'gsis_optins',
        'gsis_optpolicy',
        'philhealth_ps',
        'philhealth_gs',
        'hdmf_ps',
        'hdmf_gs',
        'hdmf_calamity_loan',
        'hdmf_mpl',
        'hdmf_rlestate',
        'wtax',
        'ppsta',
        'CEAP',
        'pave',
        'PAVE_dues',
        'ONB_loan',
        'PNB_beneficial',
        'zcspc_regular_loan',
        'zcspc_finance_loan',
        'zcspc_paidup_cap',
        'LBP_loan',
        'DBP_loan',
        'nhmfc',
        'lightwater',
        'Coopln3',
        'tuition',
        'unionpay',
        'refund',
        'encoder',
        'encode_date',
        'encode_date1',
        'grosspay',
        'netpay',
        'paydate',
        'gsis_housing1',
        'isupload'
    ];
}
