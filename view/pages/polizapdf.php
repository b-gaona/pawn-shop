<?php
require_once __DIR__ . "/../../includes/app.php";
auth();

use Dompdf\Dompdf;

$actualDate = date('Y-M-d', strtotime($poliza->getDate()));
$plusDate = date('Y-M-d', strtotime('+1 month', strtotime($poliza->getDate())));
$invoice = $poliza->getInvoice();
$consumidorName = $consumidor->getName();
$consumidorCell = $consumidor->getCellphone();
$consumidorAdd = $consumidor->getAddress();
$titularName = $titular->getName();
$titularCell = $titular->getCellphone();
$titularAdd = $titular->getAddress();
$beneficiarioName = $beneficiario->getName();
$loanAmount = $producto->getLoan_amount();
$productDescription = $producto->getDescription();
$appraisalAmount = $producto->getAppraisal_amount();


// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
html{
  box-sizing: border-box;
  font-size: 62.5%;
  margin: 30px 0x 0px 0px;
}
*,*:before, *:after{
  box-sizing: inherit;
}
body{
  font-size: 1.2rem;
  line-height: 1.5;
}
p{
  margin: 0;
}
table{
  border-collapse: collapse;
}
th, td{
  border: solid 1px black;
}
td{
  text-align: center;
}
.hoja{
  margin: 0;
  width: 21.6cm;
  height: 26.9cm;
}
.row{
  border: solid 1px black;
}
.block{
  display: block;
}
.flex{
  display: flex;
}
.justify-content-between{
  justify-content: space-between;
}
.gap-2{
  gap: 2rem;
}
.smallest{
  font-size: 1rem;
}
.small{
  font-size: 1.1rem;
}
.small-1{
  font-size: 1.2rem;
}
.small-2{
  font-size: 1.3rem;
}
.back-blue{
  background-color: #BDD7EE;
}
</style>
<body>
  <div id="tabla_imprimir" class="hoja">
    <table class="row">
      <tbody>
        <tr>
          <td colspan="4">Fecha de celebración del contrato; en la ciudad de Reynosa a: </td>
          <td colspan="2"> '.$actualDate.'</td>
          <td>Folio No: </td>
          <td colspan="2">'.$invoice.'</td>
        </tr>
        <tr>
          <td colspan="9" class="small"><strong>CONTRATO DE MUTUO CON INTERÉS Y GARANTÍA PRENDARIA (PRÉSTAMO)</strong> , que celebran el préstamo "EL PROVEEDOR", con domicilio en: Río Mante #235</td>
        </tr>
        <tr>
          <td>Libertad Longoria</td>
          <td>RFC: CALM910808</td>
          <td>TEL: 8994548567</td>
          <td colspan="2"> y "EL CONSUMIDOR": </td>
          <td colspan="4">'.$consumidorName.'</td>
        </tr>
        <tr>
          <td colspan="2">, que se identifica con número de teléfono: </td>
          <td colspan="2">'.$consumidorCell.'</td>
          <td>con domicilio en: </td>
          <td colspan="4">'.$consumidorAdd.'</td>
        </tr>
        <tr>
          <td>quien se designa como titular a: </td>
          <td colspan="3">'.$titularName.'</td>
          <td colspan="2">, que se identifica con número de teléfono: </td>
          <td colspan="2">'.$titularCell.'</td>
          <td>con domicilio en: </td>
        </tr>
        <tr>
          <td colspan="2">'.$titularAdd.'</td>
          <td>y beneficiario a: </td>
          <td colspan="4">'.$beneficiarioName.'</td>
          <td colspan="2">solo para efectos de este contrato.</td>
        </tr>
        <tr class="back-blue">
          <td rowspan="2">CAT <br />Costo Anual Total</td>
          <td rowspan="2">TASA DE INTERÉS ANUAL</td>
          <td rowspan="2" colspan="2">MONTO DEL PRÉSTAMO (MUTUO)</td>
          <td rowspan="2">MONTO TOTAL A PAGAR</td>
          <td colspan="4">COMISIONES</td>
        </tr>
        <tr class="back-blue">
          <td colspan="4">Montos y cláusulas</td>
        </tr>
        <tr>
          <td>
            <p>Para fines informativos y de comparación</p>
            <p>%FIJO</p>
            <p>Sin IVA</p>
          </td>
          <td>
            <p>96 %</p>
            <p>TASA</p>
            <p>FIJA</p>
          </td>
          <td colspan="2">
            <p>$ '.$loanAmount.'</p>
            <p>Moneda Nacional</p>
          </td>
          <td>Estimado al plazo máximo de desempeño o refrendo</td>
          <td colspan="4">
            <p>Almacenaje 12% (Claus. 10 a)</p>
            <p>Comercialización 0% (Claus. 10 b)</p>
            <p>Desempeño Extemporáneo 20% (Claus. 10 c)</p>
            <p>Reposición de contrato $12 (Claus. 10 d)</p>
          </td>
        </tr>
        <tr>
          <td colspan="9">
            <strong>Metodología de cálculo de interés: Tasa de interés anual fija dividida entre 360 días por el importe del saldo insoluto</strong>
          </td>
        </tr>
        <tr>
          <td colspan="7">
            <strong>Plazo del préstamo</strong> (Fecha límite para el refrendo o desempeño):
          </td>
          <td colspan="2">'.$plusDate.'</td>
        </tr>
        <tr>
          <td colspan="7"> <strong>Su pago será: </strong></td>
          <td colspan="2">$ '.$loanAmount.'</td>
        </tr>
        <tr>
          <td rowspan="3">OPCIONES DE PAGO PARA REFRENDO O DESEMPEÑO</td>
          <td rowspan="2">NÚMERO</td>
          <td colspan="4">MONTO</td>
          <td colspan="2">TOTAL A PAGAR</td>
          <td rowspan="2">CUÁNDO SE REALIZAN LOS PAGOS</td>
        </tr>
        <tr>
          <td>IMPORTE DEL MUTUO</td>
          <td>INTERESES</td>
          <td>ALMACENAJE</td>
          <td>PORCENTAJE</td>
          <td>POR REFERENDO</td>
          <td>POR DESEMPEÑO</td>
        </tr>
        <tr>
          <td>1</td>
          <td>$ '.$loanAmount.'</td>
          <td>$ '.($loanAmount * 0.22).'</td>
          <td>0</td>
          <td>22 %</td>
          <td>0</td>
          <td>$'.($loanAmount * 0.22 + $loanAmount).'</td>
          <td>'.$plusDate.'</td>
        </tr>
        <tr class="back-blue">
          <td colspan="5">COSTO MENSUAL TOTAL</td>
          <td colspan="4">COSTO DIARIO TOTAL</td>
        </tr>
        <tr>
          <td colspan="5">
            <p class="small"> Para fines informativos y de comparación</p>
            <p class="small"> %FIJO sin IVA</p>
          </td>
          <td colspan="4">
            <p class="small"> Para fines informativos y de comparación</p>
            <p class="small"> %FIJO sin IVA</p>
          </td>
        </tr>
        <tr>
          <td colspan="9">
            <p> <strong>"Cuide su capacidad de pago, generalmente no debe de exceder del 35% de sus ingresos"</strong> </p>
            <p> <strong>"Si usted no paga en tiempo y forma corre el riesgo de perder sus prendas"</strong> </p>
          </td>
        </tr>
        <tr>
          <td colspan="7">
            <strong>
              Autorización: Los datos personales pueden utilizarse para mercadeo:
            </strong>
          </td>
          <td>() Si</td>
          <td>() No</td>
        </tr>
        <tr>
          <td colspan="9">
            <strong>
              GARANTÍA: Para garantizar el pago de este préstamo, el consumidor deja en garantía el bien que se describe a continuación:
            </strong>
          </td>
        </tr>
        <tr class="back-blue">
          <td colspan="9">DESCRIPCIÓN DE LA PRENDA</td>
        </tr>
        <tr>
          <td rowspan="2">Descripción genérica</td>
          <td colspan="3">CARACTERÍSTICAS</td>
          <td>AVALÚO</td>
          <td>PRÉSTAMO</td>
          <td colspan="3">% PRESTAMO SOBRE AVALÚO</td>
        </tr>
        <tr>
          <td colspan="3">'.$productDescription.'</td>
          <td>$ '.$appraisalAmount.'</td>
          <td>$ '.$loanAmount.'</td>
          <td colspan="3">$ '.$loanAmount.'</td>
        </tr>
        <tr>
          <td>Monto del avalúo $</td>
          <td colspan="3">$ '.$appraisalAmount.'</td>
          <td colspan="3">Porcentaje del préstamo sobre el avalúo: </td>
          <td colspan="2">22 %</td>
        </tr>
        <tr>
          <td colspan="2">Fecha de inicio de comercialización: </td>
          <td colspan="2">'.$actualDate.'</td>
          <td colspan="3">Fecha límite de finiquito: </td>
          <td colspan="2">'.$plusDate.'</td>
        </tr>
        <tr>
          <td colspan="7">Estos conceptos causarán el pago del impuesto al valor agregado (IVA) a la tasa del: </td>
          <td colspan="2">22 %</td>
        </tr>
        <tr>
          <td colspan="9">*El procedimiento para desempeño, refrendo, finiquito y reclamo del remanente se encuentra descrito en el contrato.</td>
        </tr>
        <tr>
          <td colspan="9">Dudas, aclaraciones y reclamaciones: <br /> Para cualquier duda, aclaración o reclamación, favor de dirigirse a: Rio Mante #235 Libertad Longoria. <br /> Teléfono: 899-454-85-67</td>
        </tr>
        <tr class="back-blue">
          <td colspan="6">Datos de inscripción en el Registro Público de Contratos de Adhesión: Registrado bajo el número</td>
          <td>'.$consumidorCell.'</td>
          <td>de fecha: </td>
          <td>'.$actualDate.'</td>
        </tr>
        <tr>
          <td colspan="6">DESEMPEÑO</td>
          <td colspan="3"> FIRMAS</td>
        </tr>
        <tr>
          <td colspan="6" rowspan="2">
            <p>EL CONSUMIDOR recoge en el acto y a su entera satisfacción la(s) prenda (s) arriba descrita(s), por lo que otorga a: el finiquito más amplio que en derecho corresponda, liberándolo de cualquier responsabilidad jurídica que hubiere surgido o pudiese surgir en relación al contrato y a la prenda.</p>
          </td>
          <td>FECHA:</td>
          <td colspan="2">'.$actualDate.'</td>
        </tr>
        <tr>
          <td colspan="6">
            <p>__________________________</p>
            <p>EL CONSUMIDOR</p>
          </td>
        </tr>
        <tr>
          <td rowspan="2" colspan="2">FECHA: </td>
          <td rowspan="2" colspan="4">'.$actualDate.'</td>
          <td colspan="3">
            <p>__________________________</p>
            <p>El Proveedor</p>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <p>__________________________</p>
            <p>El valuador</p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($invoice.".pdf");
