@extends('layouts.prestataire')

@section('title',"Préstataire - Transactions")

@section('js_css')

@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">Historique des Transactions<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Montant</th>
                <th>Motif</th>
                <th>Date Transaction</th>
            </tr>
        </thead>
        <tbody>
            @php($index=1)
            @foreach($transactions as $transaction)
            <tr>
                <td>{{$index}}</td>

                @if($transaction->evaluation=="+")
                    <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> {{$transaction->montant }}</span></td>
                @endif
                @if($transaction->evaluation=="-")
                    <td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> {{$transaction->montant }}</span></td>
                @endif

                <td>{{$transaction->motif}}</td>
                <td>{{$transaction->created_at}}</td>
            </tr>
            @php($index++)
            @endforeach
        </tbody>
    </table>
</div>
</div>
</form>
</div>
@endsection

@section('script_footer')

@endsection
