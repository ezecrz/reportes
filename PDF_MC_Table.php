<?php
require'../fpdf181/fpdf.php';

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++){
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    }
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger){
        $this->AddPage($this->CurOrientation);
    }
}

function NbLines($w, $txt) {
    // Handle empty text or single-line text
    if (empty($txt) || strlen($txt) <= 1) {
        return 1;
    }

    $cw = &$this->CurrentFont['cw'];
    $wMax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;

    $lines = 1;
    $currentLineWidth = 0;
    $lastSpace = -1;

    for ($i = 0; $i < strlen($txt); $i++) {
        $char = $txt[$i];

        if ($char === "\n") {
            $lines++;
            $currentLineWidth = 0;
            $lastSpace = -1;
            continue;
        }

        $charWidth = $cw[$char];
        $currentLineWidth += $charWidth;

        if ($currentLineWidth > $wMax) {
            if ($lastSpace !== -1) {
                $i = $lastSpace;
            }
            $lines++;
            $currentLineWidth = 0;
            $lastSpace = -1;
        } else if ($char === ' ') {
            $lastSpace = $i;
        }
    }

    return $lines;
}

function calculateWordWidth($word, $cw) {
    $width = 0;
    for ($i = 0; $i < strlen($word); $i++) {
        $width += $cw[$word[$i]];
    }
    return $width;
}
    return $nl;
}
}
?>
