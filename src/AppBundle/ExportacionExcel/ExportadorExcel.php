<?php

namespace AppBundle\ExportacionExcel;



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Style;

class ExportadorExcel
{
    public function exportarDatosListados($titulo ,$subtitulo ,$encabezados ,$valores , $nombres)
    {
        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->
        getProperties()
            ->setCreator("YADRIAN y ALAIN")
            ->setLastModifiedBy($nombres)
            ->setTitle($titulo)
            ->setSubject($subtitulo)
            ->setDescription("Documento generado con CONTFIN")
            ->setKeywords("CONTFIN")
            ->setCategory("LISTADOS");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$titulo);


        $i = 3;
        foreach($encabezados as $clave => $valor){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i , $clave.':');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i , $valor);
            $i++;
        }
        $i--;

        $estiloEncabezado = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#e95e25'
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B3:B'.$i)->applyFromArray($estiloEncabezado);


        $lastColumn = 'A';
        $fila = $i + 2;
        $i = 1;

        foreach($valores[0] as $clave => $valor){

            $dato = $clave;

            if($clave == 'No') $dato = 'No Expediente';
            if($clave == 'Administrador') $dato = 'Administrador del Crédito';

            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i,$fila, $dato);
            if($i != count($valores[0])) $lastColumn++;
            $i++;
        }

        $estiloCampos = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#222222'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#E95E25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_THIN
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $cadena = $lastColumn;
        $cadena.= $fila;
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':'.$cadena)->applyFromArray($estiloCampos);

        $fila++;
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,$fila);

        $inicioInfo = $fila;

        foreach($valores as $valor){

            $column = 1;

            foreach($valor as $clave => $value){

                $dato = $value;

                if($clave == 'Fecha')  $dato = $value->format('Y-m-d');
                if($clave == 'No')
                {
                    $year = $valor['Fecha']->format('Y');
                    $dato = $year.' - '.$value;
                }
                if($clave == 'Monto')
                {
                    $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
                    $dato = $fmt->format($value);
                    $array = explode(',', $dato);
                    $dato = $array[0].' XAF';
                }

                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($column,$fila, $dato);
                $column++;
            }
            $fila++;
        }

        $estiloTituloReporte = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => '111111'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#e95e25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER_CONTINUOUS,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastColumn.'1')->applyFromArray($estiloTituloReporte);

        $estiloInformacion = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>10,
                'color'     => array(
                    'rgb' => '222222'
                )
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_MEDIUM
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $cadena = $lastColumn;
        $cadena.= ($fila - 1);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$inicioInfo.':'.$cadena)->applyFromArray($estiloInformacion);


        for($j = 'A'; $j <= $lastColumn; $j++){

            if($j !== 'C'){
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setAutoSize(true);
            }else{
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setWidth(50);
            }
        }
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:'.$lastColumn.'1');


        $objPHPExcel->getActiveSheet()->setTitle($subtitulo);

        $objPHPExcel->setActiveSheetIndex(0);


        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$subtitulo.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($objPHPExcel);
        $writer->save('php://output');

        exit;
    }

    public function exportarDatosPresupuesto($titulo ,$subtitulo ,$encabezados ,$valores , $nombres)
    {
        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->
        getProperties()
            ->setCreator("YADRIAN y ALAIN")
            ->setLastModifiedBy($nombres)
            ->setTitle($titulo)
            ->setSubject($subtitulo)
            ->setDescription("Documento generado con CONTFIN")
            ->setKeywords("CONTFIN")
            ->setCategory("LISTADOS");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$titulo);


        $i = 3;
        foreach($encabezados as $clave => $valor){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i , $clave.':');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i , $valor);
            $i++;
        }
        $i--;

        $estiloEncabezado = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#e95e25'
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B3:B'.$i)->applyFromArray($estiloEncabezado);


        $lastColumn = 'A';
        $fila = $i + 2;
        $i = 1;

        foreach($valores[0] as $clave => $valor){

            $dato = $clave;

            if($clave == 'codigoseccion')  $dato = 'Código Sección';
            if($clave == 'nombreseccion')  $dato = 'Nombre Sección';
            if($clave == 'codigoservicio') $dato = 'Código Servicio';
            if($clave == 'nombreservicio') $dato = 'Nombre Servicio';
            if($clave == 'codigonumeroeconomico') $dato = 'Código Número Económico';
            if($clave == 'nombrenumeroeconomico') $dato = 'Nombre Número Económico';
            if($clave != 'idSeccion' and $clave != 'idServicio' and $clave != 'Confidencial' and $clave != 'Compromiso'){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i,$fila, $dato);
                if($i != count($valores[0])) $lastColumn++;
                $i++;
            }
        }

        $estiloCampos = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#222222'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#E95E25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_THIN
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $cadena = $lastColumn;
        $cadena.= $fila;
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':'.$cadena)->applyFromArray($estiloCampos);

        $fila++;
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,$fila);

        $inicioInfo = $fila;

        foreach($valores as $valor){

            $column = 1;

            foreach($valor as $clave => $value){

                $dato = $value;

                if($clave != 'idSeccion' and $clave != 'idServicio' and $clave != 'Confidencial' and $clave != 'Compromiso')
                {
                    if($clave == 'Presupuesto' or $clave == 'Liquidez' or $clave == 'Disponibilidad')
                    {
                        $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
                        $dato = $fmt->format($value);
                        $array = explode(',', $dato);
                        $dato = $array[0].' XAF';
                    }
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($column,$fila, $dato);
                    $column++;
                }

            }
            $fila++;
        }

        $estiloTituloReporte = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => '111111'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#e95e25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER_CONTINUOUS,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastColumn.'1')->applyFromArray($estiloTituloReporte);

        $estiloInformacion = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>10,
                'color'     => array(
                    'rgb' => '222222'
                )
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_MEDIUM
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $cadena = $lastColumn;
        $cadena.= ($fila - 1);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$inicioInfo.':'.$cadena)->applyFromArray($estiloInformacion);


        for($j = 'A'; $j <= $lastColumn; $j++){

            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setAutoSize(true);
        }
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:'.$lastColumn.'1');


        $objPHPExcel->getActiveSheet()->setTitle($subtitulo);

        $objPHPExcel->setActiveSheetIndex(0);


        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$subtitulo.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($objPHPExcel);
        $writer->save('php://output');

        exit;
    }

    public function exportarDatosMandamientosPagos($titulo ,$subtitulo ,$encabezados ,$expedientes , $nombres)
    {
        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->
        getProperties()
            ->setCreator("YADRIAN y ALAIN")
            ->setLastModifiedBy($nombres)
            ->setTitle($titulo)
            ->setSubject($subtitulo)
            ->setDescription("Documento generado con CONTFIN")
            ->setKeywords("CONTFIN")
            ->setCategory("LISTADOS");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$titulo);


        $i = 3;
        foreach($encabezados as $clave => $valor){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i , $clave.':');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i , $valor);
            $i++;
        }
        $i--;

        $estiloEncabezado = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#e95e25'
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B3:B'.$i)->applyFromArray($estiloEncabezado);


        $lastColumn = 'F';
        $fila = $i + 2;

        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$fila, 'Fecha');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$fila, 'No Expediente');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3,$fila, 'Beneficiario');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4,$fila, 'Administrador del Crédito');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5,$fila, 'Monto');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(6,$fila, 'Estado');


        $estiloCampos = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#222222'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#E95E25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_THIN
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $cadena = $lastColumn;
        $cadena.= $fila;
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':'.$cadena)->applyFromArray($estiloCampos);

        $fila++;
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,$fila);

        $inicioInfo = $fila;

        foreach($expedientes as $expediente){

            $fecha = $expediente->getFechaentrada()->format('Y-m-d');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$fila, $fecha);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$fila, $expediente->getNumeroExpedienteMostrar());
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3,$fila, $expediente->getBeneficiario());
            $seccion = $expediente->getSeccion()->getNombreseccion();
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4,$fila, $seccion);
            $mandamientosPagos = $expediente->getMandamientosPagos();
            $lastMandamiento = $mandamientosPagos[count($mandamientosPagos) - 1];
            $monto = $lastMandamiento->getImportemandamientopago();
            $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
            $dato = $fmt->format($monto);
            $array = explode(',', $dato);
            $dato = $array[0].' XAF';
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5,$fila, $dato);
            $estado = $expediente->getEstadoexpedienteinstancia()->getEstadoexpediente();
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(6,$fila, $estado->getNombreestado());
            $fila++;
        }

        $estiloTituloReporte = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => '111111'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#e95e25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER_CONTINUOUS,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastColumn.'1')->applyFromArray($estiloTituloReporte);

        $estiloInformacion = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>10,
                'color'     => array(
                    'rgb' => '222222'
                )
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_MEDIUM
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $cadena = $lastColumn;
        $cadena.= ($fila - 1);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$inicioInfo.':'.$cadena)->applyFromArray($estiloInformacion);


        for($j = 'A'; $j <= $lastColumn; $j++){

            if($j !== 'C'){
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setAutoSize(true);
            }else{
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setWidth(50);
            }
        }
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:'.$lastColumn.'1');


        $objPHPExcel->getActiveSheet()->setTitle($subtitulo);

        $objPHPExcel->setActiveSheetIndex(0);


        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$subtitulo.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($objPHPExcel);
        $writer->save('php://output');

        exit;
    }

    public function exportarLeyPresupuesto($titulo, $subtitulo , $encabezados ,$presupuestos ,$nombres , $servicios ,$presupuestoTotalV)
    {
        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->
        getProperties()
            ->setCreator("YADRIAN y ALAIN")
            ->setLastModifiedBy($nombres)
            ->setTitle($titulo)
            ->setSubject($subtitulo)
            ->setDescription("Documento generado con CONTFIN")
            ->setKeywords("CONTFIN")
            ->setCategory("LISTADOS");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$titulo);

        $i = 3;
        foreach($encabezados as $clave => $valor){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i , $clave.':');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i , $valor);
            $i++;
        }
        $i--;

        $estiloEncabezado = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#e95e25'
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B3:B'.$i)->applyFromArray($estiloEncabezado);

        $lastColumn = 'A';
        $fila = $i + 2;
        $i = 1;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i,$fila, 'NE');
        foreach($servicios as $servicio){

            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i + 1,$fila, 'Serv'.$servicio->getCodigoservicio());
            if($i != count($servicios) +1 ) $lastColumn++;
            $i++;
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i + 1,$fila, 'TOTAL');

        $estiloCampos = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>12,
                'color'     => array(
                    'rgb' => '#222222'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#E95E25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_THIN
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $lastColumn++;
        $cadena = $lastColumn;
        $cadena.= $fila;
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':'.$cadena)->applyFromArray($estiloCampos);

        $fila++;
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,$fila);

        $inicioInfo = $fila;
        $col = 1;
        $fila--;
        $codigoNE = '';
        $pos = 0;
        $totalH = 0;
        While($pos < count($presupuestos)){

            if( $codigoNE == $presupuestos[$pos]['codigonumeroeconomico'])
            {
                $col++;
                $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
                $dato = $fmt->format($presupuestos[$pos]['Disponibilidad']);
                $array = explode(',', $dato);
                $dato = $array[0].' XAF';
                $totalH += $presupuestos[$pos]['Disponibilidad'];
                $pos++;
            }else{
                if($codigoNE != ''){
                    $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
                    $total =  $fmt->format($totalH);
                    $array = explode(',', $total);
                    $total = $array[0].' XAF';
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col + 1,$fila, $total);
                    $totalH = 0;
                }
                $col = 1;
                $fila++;
                $codigoNE = $presupuestos[$pos]['codigonumeroeconomico'];
                $dato = $presupuestos[$pos]['codigonumeroeconomico'];
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col,$fila, $dato);
        }
        $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
        $total =  $fmt->format($totalH);
        $array = explode(',', $total);
        $total = $array[0].' XAF';
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col + 1,$fila, $total);

        $col = 1;
        $fila++;
        $totalGeneral = 0;
        $pos = 0;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col , $fila , 'TOTAL');

        While($pos < count($presupuestoTotalV))
        {
            $col++;
            $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
            $dato = $fmt->format($presupuestoTotalV[$pos]['Disponibilidad']);
            $array = explode(',', $dato);
            $dato = $array[0].' XAF';
            $totalGeneral += $presupuestoTotalV[$pos]['Disponibilidad'];
            $pos++;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col,$fila, $dato);
        }

        $fmt = new \NumberFormatter('de_DE',\NumberFormatter::CURRENCY);
        $total =  $fmt->format($totalGeneral);
        $array = explode(',', $total);
        $total = $array[0].' XAF';
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col + 1,$fila, $total);

        $estiloTituloReporte = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => '111111'
                )
            ),
            'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array(
                    'rgb' => '#e95e25')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER_CONTINUOUS,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastColumn.'1')->applyFromArray($estiloTituloReporte);

        $estiloInformacion = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => false,
                'italic'    => false,
                'strike'    => false,
                'size' =>10,
                'color'     => array(
                    'rgb' => '222222'
                )
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_MEDIUM
                )

            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $cadena = $lastColumn;
        $cadena.= $fila;
        $objPHPExcel->getActiveSheet()->getStyle('A'.$inicioInfo.':'.$cadena)->applyFromArray($estiloInformacion);


        for($j = 'A'; $j <= $lastColumn; $j++){

            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setAutoSize(true);
        }
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:'.$lastColumn.'1');


        $objPHPExcel->getActiveSheet()->setTitle($subtitulo);

        $objPHPExcel->setActiveSheetIndex(0);


        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$subtitulo.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($objPHPExcel);
        $writer->save('php://output');

        exit;

    }

}