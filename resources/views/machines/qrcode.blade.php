
<style>
    .card_qrcode{
        width: 220px;
        padding: 10px;
        text-align: center;
        border: solid 2px black;
        margin: 10px;
        color: black;
    }
    .card_qrcode img{
        width: 200px;
        margin: 0px auto;
    }

    @media print {
    body * {
        visibility: hidden;
    }
    #section-to-print, #section-to-print * {
        visibility: visible;
    }
    #section-to-print {
        position: absolute;
        left: 0;
        top: 0;
    }
    #printbutton{
        visibility: hidden;
    }
}
</style>
<div id="section-to-print" class="card_qrcode"> 
Descrição: <b>{{$machine->description}}</b><br>
Nº ID: {{$machine->identification_number}}<br>
Ano: {{$machine->year_manufacture}}<br>
<img src="{{url('machines/'.$machine->id.'/qrcode')}}" alt="">
    <input type="button" id="printbutton" value="Imprimir" onClick="window.print()"/>
</div>

