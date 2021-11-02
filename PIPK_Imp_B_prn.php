<?php date_default_timezone_set('Asia/Dhaka');  ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PO Invoice </title>
<style type="text/css">
<!--
.style2 {font-size: 22px;
	font-weight: bold;
	font-family: Verdana;
}
.style3 {font-size: 10px}
-->
</style>
</head>
<?php
require_once ('class.numbertoword.php');
require_once ('class.numbertoword1.php');

?>

<body>
<?php
// Make a MySQL Connection
require ('dbcon.php');
//mysql_connect("system.corvoltd.com", "Admin", "dilhdk") or die(mysql_error());
//mysql_select_db("firefox") or die(mysql_error());


$pono_internal=trim($_GET['Internal'] );



//echo"<H2 > Sales Confirmation </H2>";

$result1 = mysql_query("SELECT * FROM PI_Imp_B_Head WHERE  Internal='$pono_internal' ")
or die(mysql_error());


// store the record of the "example" table into $row
$row1 = mysql_fetch_array( $result1 );

$pono=$row1['PO_No'];
$podate=$row1['PO_Date'];
$supid=$row1['SupID'];
$cbm=$row1['CBM'];
$frmmm=$row1['From'];
$Too=$row1['To'];
$goods=$row1['Goods'];
$blno=$row1['BLno'];
$Import_Terms=$row1['Import_Terms'];
//echo  $frmmm;



$result = mysql_query("SELECT * FROM Supplier where Sup_ID='".$row1['Tittle']."'")
or die(mysql_error());

// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );

$tname=$row['Company_Name'];

//echo " Address: ".$row['Add1'];
$ad1=$row['Add1'];
$ad2=$row['Add2'];
$ad3=$row['Add3'];
$email=$row['Email1'];
$tel=$row['TelNo1'];
$fax=$row['Fax'];



		   $curr=$row1['Currency'];

		 //  if($curr=="US$") {
         //      $curr='$';
			   $curr_name="US DOLLARS";
		//	  }
         //   else
		  //   {
	//		 if($curr=="EURO")
	 //              {
	//			   $curr='&euro;';
	//			   $curr_name="EURO";
	//			  }
	//	       }
	//		 if($curr=="NT$")
	//               {
	//			   $curr="NT$";
	//			    $curr_name=" TAIWAN DOLLAR ";
	//			  }
	//		 if($curr=="RMB")
	 //              {
	//			   $curr="RMB";
	//			   $curr_name="RENMINBI";
	//			  }


?>
<table width="800" border="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="20" colspan="6"><div align="center"><span class="style2"><?php print $tname ?></span></div></td>
    <td width="1"></td>
  </tr>
  <tr>
    <td height="20" colspan="6"><div align="center"><span class="style3"><?php print $ad1  ?>, <?php print $ad2  ?> , <?php print $ad3  ?></span></div></td>
    <td></td>
  </tr>
  <tr>
    <td height="20" colspan="6"><div align="center"><span class="style3">Tel:<?php print $tel  ?> ,Fax: <?php print $fax  ?>,Email:<?php print $email ?></span></div></td>
    <td></td>
  </tr>
  <tr>
    <td height="28" colspan="6"><div align="center" class="style2"><u>PACKING LIST </u></div></td>
    <td></td>
  </tr>
  <!--tr>
    <td height="21" colspan="2">Invoice No:<?php /*print $blno*/ ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
  </tr-->
  <tr>
    <td height="21" colspan="2">Invoice  No : <?php echo $row1['Invoice_No'];; ?></td>
    <td width="64"><div align="left">DATE</div></td>
    <td width="80"><?php echo $row1['InvDate'];; ?></td>
    <td width="36"></td>
    <td width="96"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" valign="top">Mersses : <?php

$result = mysql_query("SELECT * FROM Title where Title_ID='".$row1['Customer']."'")
or die(mysql_error());

// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );

print $row['Name']."<br>";

print $row['Add1']."<br>";
print $row['Add2']."<br>";
print $row['Add3']."<br>";
if (strlen(trim( $row['Tel']))>0) {
echo "TelNo: " . $row['Tel']."<br>";
}
if (strlen(trim( $row['Fax']))>0) {
echo "FaxNo: " . $row['Fax'];
}
    ?> </td>
    <td height="44">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>

  <tr>
    <td height="21" colspan="4">SHIPPPING MARKS </td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4" rowspan="7" valign="top"><?php

	$result = mysql_query("SELECT * FROM PI_Imp_B_Rmks where Internal='$pono_internal'")
or die(mysql_error());

// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );

$ShpMarks=$row['ShpMarks'];
$Rmks=$row['Rmks'];

echo nl2br($ShpMarks);

 ?></td>
    <td height="-2"></td>
  </tr>
  <tr>
    <td width="340" height="21">&nbsp;</td>
    <td width="94">&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td height="21" colspan="2">NAME OF VESSEL : <?php echo $row1['Vessel'];; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="21" colspan="2">CONTAINER NO : <?php echo $row1['ContainerNo'];; ?></td>
    <td></td>
  </tr>
  <tr>
    <td height="21" colspan="2">ETD : <?php echo $row1['ETD'];; ?></td>
    <td></td>
  </tr>
  <tr>

    <td height="21" colspan="2">ETA : <?php echo $row1['ETA'];; ?></td>
    <td></td>
  </tr>
  <?
 // $fromm=$row1['From'];
  //echo $fromm;
   //$too=$row1['To'];
	$result1 = mysql_query("SELECT * FROM Loading_Ports where Port_Name='".$frmmm."'")
    or die(mysql_error());
    $row1 = mysql_fetch_array( $result1 );
    $country=$row1['Country'];

	$result22 = mysql_query("SELECT * FROM Destinations where Destination='".$Too."'")
    or die(mysql_error());
    $row22 = mysql_fetch_array( $result22 );
    $country1=$row22['Country'];

	?>
  <tr>
    <td height="21" colspan="2">FROM : <?php echo $frmmm; ?> ,<?php print $country?> To  <?php echo $Too; ?> ,<?php print $country1?></td>
    <td></td>
  </tr>
  <tr>
    <td height="21" colspan="2">GOODS : <?php echo $goods ?></td>
    <td colspan="4" valign="top"></td>
    <td></td>
  </tr>
  <tr>
    <td height="21" colspan="2">Import Term : <?php echo $Import_Terms; ?></td>
    <td colspan="4" valign="top"></td>
    <td></td>
  </tr>
  <tr>
    <td height="39"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>


  <tr>
    <td height="21" colspan="6"><div align="center"></div></td>
    <td></td>
  </tr>
  <tr>
    <td height="90" colspan="6"><table width="790" cellspacing="0" style="border:solid 1px #060 ; ">
      <tr>
        <td  style="border:solid 1px #060 ; " width="55">ITEM CODE</td>
        <td  style="border:solid 1px #060 ; " width="353">DESCRIPTION </td>
        <td  style="border:solid 1px #060 ; " width="102">QUANTITY</td>
        <td  style="border:solid 1px #060 ; " width="70"><div align="center"> PKG</div></td>
        <td  style="border:solid 1px #060 ; " width="70">PKG  No </td>
        <td  style="border:solid 1px #060 ; " width="70"><div align="center">T.N.W Kgs </div></td>
        <td  style="border:solid 1px #060 ; " width="70"><div align="center">T.G.W Kgs </div></td>
        <td  style="border:solid 1px #060 ; " width="70">Remarks </td>
      </tr>
      <?php
	   $result = mysql_query(" SELECT * FROM PI_Imp_B_Item WHERE Internal=$pono_internal   ");


	if (!$result) {
		die("Query to show fields from table failed");
	}
	else
	{
	    $PONO=" ";
		 while($record = mysql_fetch_array( $result ))
		  {
		   $po_count++;
		   $linevalue=$record['Unit_Price']*$record['QTY'];
		   $totalvalue=$totalvalue+$linevalue;
		   $totalqty=$totalqty+$record['QTY'];
		   $PONUM= $record['PoNo'];
		   $lineno= $record['LineNo'];
		   $serial=$record['SerialNo'];
                   $Cat_ID=$record['Cat_ID'];

		   $result22 = mysql_query("SELECT * FROM Parts where Internal='".$Cat_ID."' ")
           or die(mysql_error());

// store the record of the "example" table into $row
           $row22 = mysql_fetch_array( $result22 );

		   $partname=$row22['Item'];
		   /////////////////////////////

		   $result1 = mysql_query("SELECT * FROM Ref_Imp_Bulk_Inv where PO_No='".$PONUM."' AND SerialNo='".$serial."' ")
           or die(mysql_error());

// store the record of the "example" table into $row
           $row1 = mysql_fetch_array( $result1 );

		    $a1="";
		   $a2="";
		   $a3="";
		   $a4="";
		   $a5="";
		   $a6="";
		   $aa="";

		   $Item1=$row1['SubItem1'];
		   $Item2=$row1['SubItem2'];
		   $Item3=$row1['SubItem3'];
		   $Item4=$row1['SubItem4'];
		   $Item5=$row1['Subitem5'];
		   $Item6=$row1['SubItem6'];

		   $Itemv1=$row1['Subval1'];
		   $Itemv2=$row1['Subval2'];
		   $Itemv3=$row1['Subval3'];
		   $Itemv4=$row1['Subval4'];
		   $Itemv5=$row1['Subval5'];
		   $Itemv6=$row1['Subval6'];
		   $des=$row1['Description'];

		   if($Itemv1 > '0')
		   {

		   $a1="<strong>".$Item1.": </strong>".$Itemv1.",";
		   }

		   if($Itemv2 > '0')
		   {

		   $a2="<strong>".$Item2.":</strong>".$Itemv2.",";
		   }

		   if($Itemv3 > '0')
		   {

		   $a3="<strong>".$Item3.":</strong>".$Itemv3.",";
		   }

		   if($Itemv4 > '0')
		   {

		   $a4="<strong>".$Item4.":</strong>".$Itemv4.",";
		   }

		   if($Itemv5 > '0')
		   {

		   $a5="<strong>".$Item5.":</strong>".$Itemv5.",";
		   }

		    if($Itemv6 > '0')
		   {

		   $a6="<strong>".$Item6.":</strong>".$Itemv6;
		   }

		   $aa=$a1." ".$a2."  ".$a3."  ".$a4."  ".$a5."  ".$a6;

      $chain_des="";
      $Unit=$record['Unit'];
      if($Cat_ID==985 && $Unit=="Roll"){

        if(substr($record['QTY'],strpos($record['QTY'],".")+1)==0 || strpos($record['QTY'],".")==0){
          $Qtys=round($record['QTY'],0);
        }
        else{
          $Qtys=round($record['QTY'],2);
        }
        $Total_roll=$Qtys*60;
        $chain_des="(1 Roll=60 Mtr) (".$Qtys." Roll * 60=".$Total_roll." Mtr)";
      }
	 ?>
      <?php

      $selss=mysql_query("SELECT Pre_Block_Booking, Internal FROM PO_Imp_B_Head WHERE PO_No='$PONUM'");
    $rowss=mysql_fetch_assoc($selss);
    $Pre_Block_Booking=$rowss['Pre_Block_Booking'];
    $PO_Internal=$rowss['Internal'];

	   if ($PONUM!=$PONO){

		 $PONO=$PONUM;
		 $po_count=0;
		 if($po_count==0) {
	  ?>
      <tr>
        <td height="42" colspan="8" valign="top"  style="border:solid 1px #060 ; "><u><b>
          <?php
		 print "ORDER No :";
		 print  $PONO;

    if($Pre_Block_Booking==1){
      echo " (PBB)";
    }
	  ?>
        </b></u></td>
      </tr>
      <?php
	   }
	   }
	  ?>
      <tr>
        <td style="border:solid 1px #060 ; " width="55" ><?php print $record['Item_Code']; ?><br />(<?php print $partname ?>)</td>
        <td style="border:solid 1px #060 ; " width="353" ><?php print $des;

		if($aa != ""){
      echo "<br>";
		  echo $aa;
    }

		if($chain_des != ""){
      echo $chain_des;
    }

    if($Pre_Block_Booking==1){
      $Item_Codet=$record['Item_Code'];
      $selsssq=mysql_query("SELECT LineNo FROM PO_Imp_B_Item WHERE Internal='$PO_Internal' AND SerialNo='$serial' AND Item_Code='$Item_Codet'");
      $rowsssq=mysql_fetch_assoc($selsssq);
      $PO_Line=$rowsssq['LineNo'];

      $pbb_des="SC: "; $scs="";
      $selssst=mysql_query("SELECT * FROM PO_Imp_B_Item_Booking_SC WHERE PO_No='$PONUM' AND PO_Internal='$PO_Internal' AND PO_Line='$PO_Line' AND Item_Code='$Item_Codet'");
      while($rowssst=mysql_fetch_assoc($selssst)){
        for($j=1;$j<=30;$j++){
          $sc=$rowssst['Sc_No'.$j];
          if($sc!=""){
             if(strstr($scs,$sc)==false){
               if($scs!=""){
                $scs.=", ".$sc;
               }
               else{
                $scs=$sc;
               }
             }
          }
        }
      }

      if($scs!=""){
        echo "<br>";
        echo "(".$pbb_des.$scs.")";
      }
    }

		?></td>
        <td style="border:solid 1px #060 ; " width="102" ><div align="right">
		<?php
		if(substr($record['QTY'],strpos($record['QTY'],".")+1)==0 || strpos($record['QTY'],".")==0){
		print number_format ($record['QTY'],0);
		}
		else{
		print number_format ($record['QTY'],2);
		}
		?>
		<?php print $record['Unit']; ?></div></td>
        <td style="border:solid 1px #060 ; " width="280" colspan="5"><table  width="395" cellspacing="0"  border="0">
            <?php

	    $result4 = mysql_query(" SELECT * FROM PI_Imp_B_Pack WHERE LineNo=$lineno Order By CRT_From,CRT_To ")
    	or die(mysql_error());

		 if (!$result4) {
		  die("Query to show fields from table failed");
	     }
		 else
		 {
			while($row = mysql_fetch_array( $result4 ))
			{
			  $noofcarton= $noofcarton+$row['NoOfCRT'];
    $cfrom=$row['CRT_From'];
    $cto=$row['CRT_To'];
	   ?>
            <tr>
              <td   width="70" ><div align="center"><?php print number_format ($row['NoOfCRT'],0); ?></div></td>
              <td   width="70" ><div align="center"><?php print $cfrom; ?>-<?php print $cto; ?></div></td>
              <td  width="70" ><div align="center"><?php print number_format ($row['NW_TTL'],2); ?></div></td>
              <td  width="70" ><div align="center"><?php print number_format ($row['GW_TTL'],2); ?></div></td>
              <td  width="55" ><?php print $row['Remarks']; ?></td>
            </tr>
            <?php
	  	   $totaltnw=$totaltnw+$row['NW_TTL'];
           $totaltgw=$totaltgw+$row['GW_TTL'];
	  }
	  }

	  ?>
        </table></td>
      </tr>
      <?php
	   }
	  }
	  ?>
      <?php
	   $result = mysql_query("SELECT * FROM PI_Imp_B_Item_Ex WHERE Internal=$pono_internal ");


	if (!$result) {
		die("Query to show fields from table failed");
	}
	else
	{

		 while($record = mysql_fetch_array( $result ))
		  {
		     $lineno= $record['LineNo'];
		     $exqty=$exqty+$record['QTY'];
   ?>
      <tr>
        <td style="border:solid 1px #060 ; " ><?php print $record['Item_Code']; ?></td>
        <td style="border:solid 1px #060 ; " ><?php print $record['Description']; ?></td>
        <td style="border:solid 1px #060 ; " ><div align="right"><?php print number_format ($record['QTY'],0); ?><?php print $record['Unit']; ?></div></td>
      </tr>
      <?php


		 }}
	   ?>
    </table></td>
    <td></td>
  </tr>
  <td height="50" colspan="6"><table width="730" cellspacing="0" >

    <tr>
        <td width="101"></td>
        <td colspan="2" >TOTAL</td>
        <td  width="95"><div align="center">
		<?php
		if(substr($totalqty,strpos($totalqty,".")+1)==0 || strpos($totalqty,".")==0){
		print number_format ($totalqty,0);
		}
		else{
		print number_format ($totalqty,2);
		}
		?></div></td>
        <td  width="76"></td>
		<td  width="60"></td>
		<td  width="70"><div align="center"><?php print number_format ($totaltnw,2); ?></div></td>
        <td width="81"><div align="center"><?php print number_format ($totaltgw,2); ?></div></td>
    </tr>
    <tr>
        <td width="101"></td>
        <td colspan="2" >NOS OF USER MANUAL</td>
        <td  width="95"><div align="center"><?php print number_format ($exqty,0); ?></div></td>
        <td  width="76"></td>
		<td  width="60"></td>
		<td  width="70"><div align="center">KGS</div></td>
        <td width="81"><div align="center">KGS</div></td>
    </tr>

   </table></td>


  <tr>
  <?php
			$unitresult = mysql_query("SELECT  SUM(QTY) As NoOfUnit,Unit  From PI_Imp_B_Item  WHERE Internal='$pono_internal' Group By Unit " );

			 while($unitrecord = mysql_fetch_array( $unitresult ))
			 {
			  $utotal= $unitrecord['NoOfUnit'] . " ".$unitrecord['Unit'] ."  ";
			 }

   ?>
   <td height="21" colspan="4">TOTAL
    <?php if(strlen(trim($noofcarton))>0){?>  <?php print $noofcarton; }?> PKGS </td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
  <td height="21" colspan="4">N.W. :<?php print number_format ($totaltnw,2); ?>KGS</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
   <tr>
  <td height="21" colspan="4">G.W. :<?php print number_format ($totaltgw,2); ?>KGS</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
   <tr>
  <td height="21" colspan="4">MEAS :<?php print number_format ($cbm,2); ?>CBM </td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top"><?php echo nl2br($Rmks);  ?>&nbsp;</td>
    <td height="14"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="22"></td>
    <td></td>
    <td colspan="3" valign="top"><?php print $tname ?></td>
  <td></td>
  </tr>
  <tr>
    <td height="50"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>


  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" valign="top"><hr /></td>
    <td></td>
  </tr>
  <tr>
    <td height="38">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
</table>
</body>
</html>
