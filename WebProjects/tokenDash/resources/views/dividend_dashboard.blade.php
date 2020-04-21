@extends('layouts.app')

@section('htmlheader_title')
    Dividend Dashboard
@endsection

@section('contentheader_title')
    Note to Investors
@endsection

@section('main-content')
    @include('admin/partials/error')
    @include('admin/partials/success')
    <div id="error-div" style="display:none;padding: 0px !important;">
        <div class="alert alert-danger alert-dismissible">
            <ul>
                <li>
                    <p id="error_text"></p>
                </li>
            </ul>
        </div>
    </div>
    <section class="content" style="padding: 0px !important;">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?php echo htmlspecialchars_decode($dividend_settings->note); ?>
                    <br>
                    <h4><strong>Dividend Type </strong>  : {{$dividend_settings->dividend_type}}</h4>
                    <br>
                    <div class="calc">
                        <div class="row">
                            <h4><b>Dividend Calculator</b></h4>
                            <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                            <h4 style="color:grey">Amount of token to be buy</h4><h4>
                                <input placeholder="Enter tokens" style="width: 90%" type="number" value="" id="nooftokens" onkeyup="javascript:calculate(this.value);">
                            </h4>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <h4 style="color:grey">&nbsp;&nbsp;&nbsp;You will get</h4>
                            
                            @if($dividend_settings->payment_schedule=='Quarterly')
                            <?php $dividend_period=$dividend_settings->payment_schedule.' (4 times a year)'; ?>
                            @elseif($dividend_settings->payment_schedule=='Half yearly')
                            <?php $dividend_period=$dividend_settings->payment_schedule.' (2 times a year)';?>
                            @endif
                            
                            <h3>=&nbsp;&nbsp;&nbsp;&nbsp;<span id="dividend_usd">$ 0</span> <span id="dividend_period"> / {{$dividend_period}}</span></h3>
                            </div>
                       </div>
                    </div>
                    <p>Use the above calculator to calculate the ROI you will receive per security token as dividend. The DPS( Dividend per share ) is calculated by dividing the total dividends paid out by the company( over a period of time ), by the number of outstanding security tokens issued. Ex: If the company token value today is $30. The $1 represents a yield of $1 / $30 = 3.3%. Which means if you purchase security token’s for $30 today, you will earn 3.3% every year via. Dividends.</p>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection

<script>
function calculate(token)
{
    var usd=token*{{$dividend_settings->dividend_amt}};
    var final_amount=0;
    var dividend_period='{{$dividend_settings->payment_schedule}}';
    if('{{$dividend_settings->payment_schedule}}'=='Quarterly')
    {
        final_amount=usd/4;
        dividend_period='{{$dividend_settings->payment_schedule}} (4 times a year)';
    }
    else if('{{$dividend_settings->payment_schedule}}'=='Half yearly')
    {
        final_amount=usd/2;
        dividend_period='{{$dividend_settings->payment_schedule}} (2 times a year)';
    }
    $('#dividend_usd').html('$ '+parseFloat(final_amount).toFixed(2));
    $('#dividend_period').html(' / '+dividend_period);
}
</script>