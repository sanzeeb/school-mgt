<?php
/**
 * Created by PhpStorm.
 * User: Tanvir AnowarC51
 * Date: 1/13/15
 * Time: 2:42 PM
 */

class StudentFinanceReport extends TransactionReport{

    public function __construct($type,$size,$paper)
    {
        parent::__construct($type,$size,$paper);


    }

    public function reportHeader($headerData)
    {
        $student = $headerData[0]->getStudent();
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(190,260,'',1,1);
        $this->setY(10);
        $this->Cell(190,20,"INVOICE",0,1,"C");

        $this->SetFont('Arial','B',10);
        $this->Cell(25,8,"Invoice No:",0,0,"R");
        $this->SetFont('Arial','');
        $this->Cell(100,8,$headerData[0]->invoice_number,0,0);

        $this->SetFont('Arial','B',10);
        $this->Cell(25,8,"Date:",0,0,"R");
        $this->SetFont('Arial','');
        $this->Cell(25,8,Helpers::dateTimeFormat('j F, Y',$headerData[0]->created_at),0,1);

        $this->SetFont('Arial','B',10);
        $this->Cell(25,8,"Name:",0,0,"R");
        $this->SetFont('Arial','');
        $this->Cell(100,8,$student->name,0,1);

        $this->SetFont('Arial','B',10);
        $this->Cell(25,8,"Session:",0,0,"R");
        $this->SetFont('Arial','');
        $this->Cell(100,8,substr($headerData[0]->reg_id,0,4),0,1);

        $this->SetFont('Arial','B',10);
        $this->Cell(25,8,"Month:",0,0,"R");
        $this->SetFont('Arial','');
        $this->Cell(100,8,$headerData[0]->month,0,1);

        $this->Cell(100,10,"",0,1);
        $this->SetX(12);
        $this->SetFont('Arial','B',10);
        $this->Cell(20,10,"Sl No.",1,0,"C");
        $this->Cell(38,10,"Head.",1,0,"C");
        $this->Cell(74,10,"Description",1,0,"C");
        $this->Cell(20,10,"Ref No.",1,0,"C");
        $this->Cell(34,10,"Amount (BDT).",1,1,"C");

    }

    public function generateReport($finance)
    {
        $total = 0;
        foreach($finance as $i=> $tr)
        {
            $transaction = AccountTransaction::where('transaction_code',$tr->transaction_code)->first();
            $index = ($i+1);
            $this->SetFont('Arial','',10);
            $this->SetX(12);
            $this->Cell(20,10,$index,"L,R,B",0,"C");
            $this->Cell(38,10,$tr->head,"R,B",0,"C");
            $this->Cell(74,10,$tr->description,"R,B",0,"C");
            $this->Cell(20,10,$tr->ref_no,"R,B",0,"C");


                $amount = ($tr->amount);
                $total += ($tr->amount);



            $this->Cell(34,10,$amount."  ","R,B",1,"R");
            if(($index%16) == 0)
            {

                $this->AddPage();
            }
        }
        $this->SetX(12);
        $this->SetFont('Arial','B',10);
        $this->Cell(152,10,"Total ","L,R,B",0,"R");

        $this->Cell(34,10,$total."  ","R,B",1,"R");

    }

} 