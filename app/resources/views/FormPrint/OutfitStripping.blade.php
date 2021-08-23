<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style>
        html, body, div, span,
        h1, h2, h3, h4, h5, h6, p,
        a, abbr, big, em, img,
        small, strike, strong, sub, sup,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend/*,
        table, caption, tbody, tfoot, thead, tr, th, td*/ {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        }
        table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        margin: .5rem 0 2rem;
        }
        body {line-height: 1; font-size: 1rem;}
        .table th {text-align: left; border: none; border-bottom: 2px solid; font-size: 90%;}
        .table td {border-bottom: 1px solid;}
        .table th, .table td {padding: .25rem 0;}
        .table-sm th, .table-sm td {padding: .5rem;}
        .table-sm th {font-size: 90%; text-align: right; font-weight: normal;}
        .lead {text-transform: uppercase; font-size: 80%; font-weight: bold; margin-top: 1rem;}
        .text-lg {font-size: 120%;}
        .title {font-size: 160%; text-align: center; margin: 1.5rem 0;}
        .field:before {content:" "; display: inline-block; border: 2px solid; width: 70%; padding: .15rem;}
        .bb:before {content:"___________________";}
        .tr-foot td {border-top: 2px solid;}
    </style>
</head>
<body onload="window.print()">

<h2>Штрипс нарезка</h2>

<p class="text-lg">Дата заказа: {{$date}}</p>

<h1 class="title">Бухта № {{$id}}, тип металла: {{$type}}, толщина: {{$thicknesses}} мм, ширина: {{$width}} мм.</h1>

<table class="table text-lg">
    <tr>
        <th>Ширина штрипса, <em>мм</em></th>
        <th>Количество, <em>шт.</em></th>
    </tr>
    <tr>
        <td>{{$vm->width}}</td>
        <td>{{$vm->amount}}</td>
    </tr>
</table>

<table class="table-sm">
    <tr>
        <th><strong class="text-lg">Длина</strong></th>
        <td width="30%">{{$length}}</td>
    </tr>
    <tr>
        <th><strong class="text-lg">Длина фактическая</strong></th>
        <td class="bb"></td>
        <td width="10%"></td>
    </tr>
    <tr>
        <th>Смена, №</th>
        <td class="bb"></td>
        <td></td>
    </tr>
    <tr>
        <th>Дата, факт.</th>
        <td class="bb" width="20%"></td>

        <td></td>
        <th>Время, факт.</th>
        <td class="bb"></td>
    </tr>
    <tr>
        <th>Сдал, ФИО</th>
        <td class="bb"></td>
        <td></td>
        <th>Подпись (сдал)</th>
        <td class="bb"></td>
    </tr>
    <tr>
        <th>Принял, ФИО</th>
        <td class="bb"></td>
        <td></td>
        <th>Подпись (принял)</th>
        <td class="bb"></td>
    </tr>
</table>

</body>
</html>
