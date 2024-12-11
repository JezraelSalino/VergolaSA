$(':input').bind('keypress keydown keyup change mousedown',function(){  
/********** Cbeam 200 Deep First ***********/

$('#desclist1').change(function() {        
var Beam = $(this).val();
$('#desc1').val(BeamDESCArray[Beam]);
$('#invent1').val(BeamIDArray[Beam]); 
$('#descrrp1').val(BeamRRPArray[Beam]);
$('#desccost1').val(BeamCOSTArray[Beam]);
}); 

$('#webbing-list1').change(function() {
var web = $(this).val();
if ($('#webbing-list1').val() == 'No') {
		$('#webbing1').val('No');	
		$('#webrrp1').val(0);
		$('#webcost1').val(0);
		}
		else if($('#webbing-list1').val() == '5'){
		$('#webbing1').val('Yes');		
		$('#webrrp1').val(BeamRRPArray[web]);
		$('#webcost1').val(BeamCOSTArray[web]);
		}  
});

$('#paint-list1').change(function() {        
var paint = $(this).val();
$('#paintdesc1').val(BeamDESCArray[paint]);
$('#paintrrp1').val(BeamRRPArray[paint]);
$('#paintcost1').val(BeamCOSTArray[paint]);
}); 

/********** Cbeam 200 Deep Second ***********/

$('#desclist2').change(function() {        
var Beam = $(this).val();
$('#desc2').val(BeamDESCArray[Beam]);
$('#invent2').val(BeamIDArray[Beam]); 
$('#descrrp2').val(BeamRRPArray[Beam]);
$('#desccost2').val(BeamCOSTArray[Beam]);
}); 

$('#webbing-list2').change(function() {
var web = $(this).val();
if ($('#webbing-list2').val() == 'No') {
		$('#webbing2').val('No');	
		$('#webrrp2').val(0);
		$('#webcost2').val(0);
		}
		else if($('#webbing-list2').val() == '5'){
		$('#webbing2').val('Yes');		
		$('#webrrp2').val(BeamRRPArray[web]);
		$('#webcost2').val(BeamCOSTArray[web]);
		}  
});

$('#paint-list2').change(function() {        
var paint = $(this).val();
$('#paintdesc2').val(BeamDESCArray[paint]);
$('#paintrrp2').val(BeamRRPArray[paint]);
$('#paintcost2').val(BeamCOSTArray[paint]);
}); 

/********** Cbeam 250 Deep ***********/
$('#desclist3').change(function() {        
var Beam = $(this).val();
$('#desc3').val(BeamDESCArray[Beam]); 
$('#invent3').val(BeamIDArray[Beam]); 
$('#descrrp3').val(BeamRRPArray[Beam]);
$('#desccost3').val(BeamCOSTArray[Beam]);
});  

$('#webbing-list3').change(function() {
var web = $(this).val();
if ($('#webbing-list3').val() == 'No') {
		$('#webbing3').val('No');	
		$('#webrrp3').val(0);
		$('#webcost3').val(0);
		}
		else if($('#webbing-list3').val() == '5'){
		$('#webbing3').val('Yes');		
		$('#webrrp3').val(BeamRRPArray[web]);
		$('#webcost3').val(BeamCOSTArray[web]);
		}  
});



$('#paint-list3').change(function() {        
var paint = $(this).val();
$('#paintdesc3').val(BeamDESCArray[paint]);
$('#paintrrp3').val(BeamRRPArray[paint]);
$('#paintcost3').val(BeamCOSTArray[paint]);
}); 

/********** Intermediate 250 Deep ***********/
$('#desclist4').change(function() {        
var Beam = $(this).val();
$('#desc4').val(BeamDESCArray[Beam]); 
$('#invent4').val(BeamIDArray[Beam]); 
$('#descrrp4').val(BeamRRPArray[Beam]);
$('#desccost4').val(BeamCOSTArray[Beam]);
});  

$('#webbing-list4').change(function() {
var web = $(this).val();
if ($('#webbing-list4').val() == 'No') {
		$('#webbing4').val('No');	
		$('#webrrp4').val(0);
		$('#webcost4').val(0);
		}
		else if($('#webbing-list4').val() == '5'){
		$('#webbing4').val('Yes');		
		$('#webrrp4').val(BeamRRPArray[web]);
		$('#webcost4').val(BeamCOSTArray[web]);
		}  
});



$('#paint-list4').change(function() {        
var paint = $(this).val();
$('#paintdesc4').val(BeamDESCArray[paint]);
$('#paintrrp4').val(BeamRRPArray[paint]);
$('#paintcost4').val(BeamCOSTArray[paint]);
}); 


/********** First Post 90 x90 ***********/
$('#desclist5').change(function() {        
var Beam = $(this).val();
$('#desc7').val(BeamDESCArray[Beam]); 
$('#invent7').val(BeamIDArray[Beam]); 
$('#descrrp7').val(BeamRRPArray[Beam]);
$('#desccost7').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list5').change(function() {        
var paint = $(this).val();
$('#paintdesc5').val(BeamDESCArray[paint]);
$('#paintrrp5').val(BeamRRPArray[paint]);
$('#paintcost5').val(BeamCOSTArray[paint]);
}); 


/********** Second Post 90 x90 ***********/
$('#desclist6').change(function() {        
var Beam = $(this).val();
$('#desc8').val(BeamDESCArray[Beam]); 
$('#invent8').val(BeamIDArray[Beam]); 
$('#descrrp8').val(BeamRRPArray[Beam]);
$('#desccost8').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list6').change(function() {        
var paint = $(this).val();
$('#paintdesc6').val(BeamDESCArray[paint]);
$('#paintrrp6').val(BeamRRPArray[paint]);
$('#paintcost6').val(BeamCOSTArray[paint]);
}); 

/********** Third Post 90 x90 ***********/
$('#desclist7').change(function() {        
var Beam = $(this).val();
$('#desc9').val(BeamDESCArray[Beam]); 
$('#invent9').val(BeamIDArray[Beam]); 
$('#descrrp9').val(BeamRRPArray[Beam]);
$('#desccost9').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list7').change(function() {        
var paint = $(this).val();
$('#paintdesc7').val(BeamDESCArray[paint]);
$('#paintrrp7').val(BeamRRPArray[paint]);
$('#paintcost7').val(BeamCOSTArray[paint]);
}); 

/********** Fourth Post 90 x90 ***********/
$('#desclist8').change(function() {        
var Beam = $(this).val();
$('#desc10').val(BeamDESCArray[Beam]); 
$('#invent10').val(BeamIDArray[Beam]); 
$('#descrrp10').val(BeamRRPArray[Beam]);
$('#desccost10').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list8').change(function() {        
var paint = $(this).val();
$('#paintdesc8').val(BeamDESCArray[paint]);
$('#paintrrp8').val(BeamRRPArray[paint]);
$('#paintcost8').val(BeamCOSTArray[paint]);
}); 

/********** Fifth Post 90 x90 ***********/
$('#desclist9').change(function() {        
var Beam = $(this).val();
$('#desc11').val(BeamDESCArray[Beam]); 
$('#invent11').val(BeamIDArray[Beam]); 
$('#descrrp11').val(BeamRRPArray[Beam]);
$('#desccost11').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list9').change(function() {        
var paint = $(this).val();
$('#paintdesc9').val(BeamDESCArray[paint]);
$('#paintrrp9').val(BeamRRPArray[paint]);
$('#paintcost9').val(BeamCOSTArray[paint]);
}); 

/********** Sixth Post 90 x90 ***********/
$('#desclist10').change(function() {        
var Beam = $(this).val();
$('#desc12').val(BeamDESCArray[Beam]); 
$('#invent12').val(BeamIDArray[Beam]); 
$('#descrrp12').val(BeamRRPArray[Beam]);
$('#desccost12').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list10').change(function() {        
var paint = $(this).val();
$('#paintdesc10').val(BeamDESCArray[paint]);
$('#paintrrp10').val(BeamRRPArray[paint]);
$('#paintcost10').val(BeamCOSTArray[paint]);
}); 


/********** First Vergola Gutter Lip Out 200x200 ***********/
$('#desclist11').change(function() {        
var Beam = $(this).val();
$('#desc20').val(BeamDESCArray[Beam]); 
$('#invent20').val(BeamIDArray[Beam]); 
$('#descrrp20').val(BeamRRPArray[Beam]);
$('#desccost20').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list11').change(function() {        
var paint = $(this).val();
$('#paintdesc11').val(BeamDESCArray[paint]);
$('#paintrrp11').val(BeamRRPArray[paint]);
$('#paintcost11').val(BeamCOSTArray[paint]);
});

/********** Second Vergola Gutter Lip Out 250x250 ***********/
$('#desclist12').change(function() {        
var Beam = $(this).val();
$('#desc21').val(BeamDESCArray[Beam]); 
$('#invent21').val(BeamIDArray[Beam]); 
$('#descrrp21').val(BeamRRPArray[Beam]);
$('#desccost21').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list12').change(function() {        
var paint = $(this).val();
$('#paintdesc12').val(BeamDESCArray[paint]);
$('#paintrrp12').val(BeamRRPArray[paint]);
$('#paintcost12').val(BeamCOSTArray[paint]);
}); 

/********** Third Vergola Tappered Gutter Lip Out 200x250 ***********/
$('#desclist13').change(function() {        
var Beam = $(this).val();
$('#desc22').val(BeamDESCArray[Beam]); 
$('#invent22').val(BeamIDArray[Beam]); 
$('#descrrp22').val(BeamRRPArray[Beam]);
$('#desccost22').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list13').change(function() {        
var paint = $(this).val();
$('#paintdesc13').val(BeamDESCArray[paint]);
$('#paintrrp13').val(BeamRRPArray[paint]);
$('#paintcost13').val(BeamCOSTArray[paint]);
});


/********** Fourth Vergola Tappered Gutter Lip Out 250x200 ***********/
$('#desclist14').change(function() {        
var Beam = $(this).val();
$('#desc23').val(BeamDESCArray[Beam]); 
$('#invent23').val(BeamIDArray[Beam]); 
$('#descrrp23').val(BeamRRPArray[Beam]);
$('#desccost23').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list14').change(function() {        
var paint = $(this).val();
$('#paintdesc14').val(BeamDESCArray[paint]);
$('#paintrrp14').val(BeamRRPArray[paint]);
$('#paintcost14').val(BeamCOSTArray[paint]);
});

/********** Fifth Vergola Gutter Lip Out 200x200 ***********/
$('#desclist15').change(function() {        
var Beam = $(this).val();
$('#desc24').val(BeamDESCArray[Beam]); 
$('#invent24').val(BeamIDArray[Beam]); 
$('#descrrp24').val(BeamRRPArray[Beam]);
$('#desccost24').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list15').change(function() {        
var paint = $(this).val();
$('#paintdesc15').val(BeamDESCArray[paint]);
$('#paintrrp15').val(BeamRRPArray[paint]);
$('#paintcost15').val(BeamCOSTArray[paint]);
});

/********** Sixth Vergola Gutter Lip Out 250x250 ***********/
$('#desclist16').change(function() {        
var Beam = $(this).val();
$('#desc25').val(BeamDESCArray[Beam]); 
$('#invent25').val(BeamIDArray[Beam]); 
$('#descrrp25').val(BeamRRPArray[Beam]);
$('#desccost25').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list16').change(function() {        
var paint = $(this).val();
$('#paintdesc16').val(BeamDESCArray[paint]);
$('#paintrrp16').val(BeamRRPArray[paint]);
$('#paintcost16').val(BeamCOSTArray[paint]);
});


/********** Seventh Vergola Tappered Gutter Lip Out 200x250 ***********/
$('#desclist17').change(function() {        
var Beam = $(this).val();
$('#desc26').val(BeamDESCArray[Beam]); 
$('#invent26').val(BeamIDArray[Beam]); 
$('#descrrp26').val(BeamRRPArray[Beam]);
$('#desccost26').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list17').change(function() {        
var paint = $(this).val();
$('#paintdesc17').val(BeamDESCArray[paint]);
$('#paintrrp17').val(BeamRRPArray[paint]);
$('#paintcost17').val(BeamCOSTArray[paint]);
});

/********** Eight Vergola Tappered Gutter Lip Out 250x200 ***********/
$('#desclist18').change(function() {        
var Beam = $(this).val();
$('#desc27').val(BeamDESCArray[Beam]); 
$('#invent27').val(BeamIDArray[Beam]); 
$('#descrrp27').val(BeamRRPArray[Beam]);
$('#desccost27').val(BeamCOSTArray[Beam]);
}); 

$('#paint-list18').change(function() {        
var paint = $(this).val();
$('#paintdesc18').val(BeamDESCArray[paint]);
$('#paintrrp18').val(BeamRRPArray[paint]);
$('#paintcost18').val(BeamCOSTArray[paint]);
});

/********** First Gutters Non Standard Vergola Gutter Lip Out 225 x 225 ***********/
$('#desclist19').change(function() {        
var Beam = $(this).val();
$('#desc28').val(BeamDESCArray[Beam]); 
$('#invent28').val(BeamIDArray[Beam]); 
$('#descrrp28').val(BeamRRPArray[Beam]);
$('#desccost28').val(BeamCOSTArray[Beam]);
$('#uom1').val(BeamUOMArray[Beam]);
}); 

$('#paint-list19').change(function() {        
var paint = $(this).val();
$('#paintdesc19').val(BeamDESCArray[paint]);
$('#paintrrp19').val(BeamRRPArray[paint]);
$('#paintcost19').val(BeamCOSTArray[paint]);
});

/********** Second Gutters Non Standard Vergola Gutter Lip Out 200 x 225 ***********/
$('#desclist20').change(function() {        
var Beam = $(this).val();
$('#desc29').val(BeamDESCArray[Beam]); 
$('#invent29').val(BeamIDArray[Beam]); 
$('#descrrp29').val(BeamRRPArray[Beam]);
$('#desccost29').val(BeamCOSTArray[Beam]);
$('#uom2').val(BeamUOMArray[Beam]);
}); 

$('#paint-list20').change(function() {        
var paint = $(this).val();
$('#paintdesc20').val(BeamDESCArray[paint]);
$('#paintrrp20').val(BeamRRPArray[paint]);
$('#paintcost20').val(BeamCOSTArray[paint]);
});

/********** Third Gutters Non Standard Vergola Gutter Lip Out 225 x 250 ***********/
$('#desclist21').change(function() {        
var Beam = $(this).val();
$('#desc30').val(BeamDESCArray[Beam]); 
$('#invent30').val(BeamIDArray[Beam]); 
$('#descrrp30').val(BeamRRPArray[Beam]);
$('#desccost30').val(BeamCOSTArray[Beam]);
$('#uom3').val(BeamUOMArray[Beam]);
}); 

$('#paint-list21').change(function() {        
var paint = $(this).val();
$('#paintdesc21').val(BeamDESCArray[paint]);
$('#paintrrp21').val(BeamRRPArray[paint]);
$('#paintcost21').val(BeamCOSTArray[paint]);
});

/********** Fourth Gutters Non Standard Vergola Gutter Lip Out 250 x 225 ***********/
$('#desclist22').change(function() {        
var Beam = $(this).val();
$('#desc31').val(BeamDESCArray[Beam]); 
$('#invent31').val(BeamIDArray[Beam]); 
$('#descrrp31').val(BeamRRPArray[Beam]);
$('#desccost31').val(BeamCOSTArray[Beam]);
$('#uom4').val(BeamUOMArray[Beam]);
}); 

$('#paint-list22').change(function() {        
var paint = $(this).val();
$('#paintdesc22').val(BeamDESCArray[paint]);
$('#paintrrp22').val(BeamRRPArray[paint]);
$('#paintcost22').val(BeamCOSTArray[paint]);
});

/********** Fifth Gutters Non Standard Vergola Gutter Lip Out 225 x 200 ***********/
$('#desclist23').change(function() {        
var Beam = $(this).val();
$('#desc32').val(BeamDESCArray[Beam]); 
$('#invent32').val(BeamIDArray[Beam]); 
$('#descrrp32').val(BeamRRPArray[Beam]);
$('#desccost32').val(BeamCOSTArray[Beam]);
$('#uom5').val(BeamUOMArray[Beam]);
}); 

$('#paint-list23').change(function() {        
var paint = $(this).val();
$('#paintdesc23').val(BeamDESCArray[paint]);
$('#paintrrp23').val(BeamRRPArray[paint]);
$('#paintcost23').val(BeamCOSTArray[paint]);
});

/********** Sixth Gutters Non Standard Bracket Gutter 190-240 ***********/
$('#desclist24').change(function() {        
var Beam = $(this).val();
$('#desc33').val(BeamDESCArray[Beam]); 
$('#invent33').val(BeamIDArray[Beam]); 
$('#descrrp33').val(BeamRRPArray[Beam]);
$('#desccost33').val(BeamCOSTArray[Beam]);
$('#uom6').val(BeamUOMArray[Beam]);
}); 

$('#paint-list24').change(function() {        
var paint = $(this).val();
$('#paintdesc24').val(BeamDESCArray[paint]);
$('#paintrrp24').val(BeamRRPArray[paint]);
$('#paintcost24').val(BeamCOSTArray[paint]);
});

/********** Seventh Gutters Non Standard Vergola Guttering Sleeve***********/
$('#desclist25').change(function() {        
var Beam = $(this).val();
$('#desc34').val(BeamDESCArray[Beam]); 
$('#invent34').val(BeamIDArray[Beam]); 
$('#descrrp34').val(BeamRRPArray[Beam]);
$('#desccost34').val(BeamCOSTArray[Beam]);
$('#uom7').val(BeamUOMArray[Beam]);
}); 

$('#paint-list25').change(function() {        
var paint = $(this).val();
$('#paintdesc25').val(BeamDESCArray[paint]);
$('#paintrrp25').val(BeamRRPArray[paint]);
$('#paintcost25').val(BeamCOSTArray[paint]);
});

/********** Eight Gutters Non Standard Vergola Gutter Zincalume Std 250mm***********/
$('#desclist26').change(function() {        
var Beam = $(this).val();
$('#desc35').val(BeamDESCArray[Beam]); 
$('#invent35').val(BeamIDArray[Beam]); 
$('#descrrp35').val(BeamRRPArray[Beam]);
$('#desccost35').val(BeamCOSTArray[Beam]);
$('#uom8').val(BeamUOMArray[Beam]);
}); 

$('#paint-list26').change(function() {        
var paint = $(this).val();
$('#paintdesc26').val(BeamDESCArray[paint]);
$('#paintrrp26').val(BeamRRPArray[paint]);
$('#paintcost26').val(BeamCOSTArray[paint]);
});

/********** Nineth Gutters Non Standard Vergola Gutter Cbond 150mm pan***********/
$('#desclist27').change(function() {        
var Beam = $(this).val();
$('#desc36').val(BeamDESCArray[Beam]); 
$('#invent36').val(BeamIDArray[Beam]); 
$('#descrrp36').val(BeamRRPArray[Beam]);
$('#desccost36').val(BeamCOSTArray[Beam]);
$('#uom9').val(BeamUOMArray[Beam]);
}); 

$('#paint-list27').change(function() {        
var paint = $(this).val();
$('#paintdesc27').val(BeamDESCArray[paint]);
$('#paintrrp27').val(BeamRRPArray[paint]);
$('#paintcost27').val(BeamCOSTArray[paint]);
});

/***************  C Beam Face Flashing Z Al *************************/

$('#paint-list26').change(function() {        
var paint = $(this).val();
$('#paintdesc26').val(BeamDESCArray[paint]);
$('#paintrrp26').val(BeamRRPArray[paint]);
$('#paintcost26').val(BeamCOSTArray[paint]);
});

/*************** Adaptor Flashing CDB *************************/

$('#paint-list27').change(function() {        
var paint = $(this).val();
$('#paintdesc27').val(BeamDESCArray[paint]);
$('#paintrrp27').val(BeamRRPArray[paint]);
$('#paintcost27').val(BeamCOSTArray[paint]);
});

/*************** Flashing Fascia *************************/

$('#paint-list28').change(function() {        
var paint = $(this).val();
$('#paintdesc28').val(BeamDESCArray[paint]);
$('#paintrrp28').val(BeamRRPArray[paint]);
$('#paintcost28').val(BeamCOSTArray[paint]);
});

/*************** Flashing (Perimeter of C Beam) *************************/

$('#paint-list29').change(function() {        
var paint = $(this).val();
$('#paintdesc29').val(BeamDESCArray[paint]);
$('#paintrrp29').val(BeamRRPArray[paint]);
$('#paintcost29').val(BeamCOSTArray[paint]);
});

/*************** Flashing Intermediate (Dbl Bank) *************************/

$('#paint-list30').change(function() {        
var paint = $(this).val();
$('#paintdesc30').val(BeamDESCArray[paint]);
$('#paintrrp30').val(BeamRRPArray[paint]);
$('#paintcost30').val(BeamCOSTArray[paint]);
});

/*************** Flashing Special  *************************/

$('#paint-list31').change(function() {        
var paint = $(this).val();
$('#paintdesc31').val(BeamDESCArray[paint]);
$('#paintrrp31').val(BeamRRPArray[paint]);
$('#paintcost31').val(BeamCOSTArray[paint]);
});


/********** Louvres Poly and Square ***********/
$('#desclist26').change(function() {        
var Beam = $(this).val();
$('#desc45').val(BeamDESCArray[Beam]); 
$('#invent45').val(BeamIDArray[Beam]); 
$('#descrrp45').val(BeamRRPArray[Beam]);
$('#desccost45').val(BeamCOSTArray[Beam]);
}); 
$('#paint-list32').change(function() {        
var paint = $(this).val();
$('#paintdesc32').val(BeamDESCArray[paint]);
$('#paintrrp32').val(BeamRRPArray[paint]);
$('#paintcost32').val(BeamCOSTArray[paint]);
});

/*************** Endcap  *************************/

$('#paint-list33').change(function() {        
var paint = $(this).val();
$('#paintdesc33').val(BeamDESCArray[paint]);
$('#paintrrp33').val(BeamRRPArray[paint]);
$('#paintcost33').val(BeamCOSTArray[paint]);
});

/*************** Pivot Strip  *************************/

$('#paint-list34').change(function() {        
var paint = $(this).val();
$('#paintdesc34').val(BeamDESCArray[paint]);
$('#paintrrp34').val(BeamRRPArray[paint]);
$('#paintcost34').val(BeamCOSTArray[paint]);
});

/*************** Link Bar  *************************/

$('#paint-list35').change(function() {        
var paint = $(this).val();
$('#paintdesc35').val(BeamDESCArray[paint]);
$('#paintrrp35').val(BeamRRPArray[paint]);
$('#paintcost35').val(BeamCOSTArray[paint]);
});


/********** Extras 1 ***********/
$('#desclist27').change(function() {        
var Beam = $(this).val();
$('#desc56').val(BeamDESCArray[Beam]); 
$('#invent56').val(BeamIDArray[Beam]); 
$('#descrrp56').val(BeamRRPArray[Beam]);
$('#desccost56').val(BeamCOSTArray[Beam]);
$('#uom10').val(BeamUOMArray[Beam]);
}); 

/********** Extras 2 ***********/
$('#desclist28').change(function() {        
var Beam = $(this).val();
$('#desc57').val(BeamDESCArray[Beam]); 
$('#invent57').val(BeamIDArray[Beam]); 
$('#descrrp57').val(BeamRRPArray[Beam]);
$('#desccost57').val(BeamCOSTArray[Beam]);
$('#uom11').val(BeamUOMArray[Beam]);
});

/********** Extras 3 ***********/
$('#desclist29').change(function() {        
var Beam = $(this).val();
$('#desc58').val(BeamDESCArray[Beam]); 
$('#invent58').val(BeamIDArray[Beam]); 
$('#descrrp58').val(BeamRRPArray[Beam]);
$('#desccost58').val(BeamCOSTArray[Beam]);
$('#uom12').val(BeamUOMArray[Beam]);
});

/********** Extras 4 ***********/
$('#desclist30').change(function() {        
var Beam = $(this).val();
$('#desc59').val(BeamDESCArray[Beam]); 
$('#invent59').val(BeamIDArray[Beam]); 
$('#descrrp59').val(BeamRRPArray[Beam]);
$('#desccost59').val(BeamCOSTArray[Beam]);
$('#uom13').val(BeamUOMArray[Beam]);
});

/********** Extras 5 ***********/
$('#desclist31').change(function() {        
var Beam = $(this).val();
$('#desc60').val(BeamDESCArray[Beam]); 
$('#invent60').val(BeamIDArray[Beam]); 
$('#descrrp60').val(BeamRRPArray[Beam]);
$('#desccost60').val(BeamCOSTArray[Beam]);
$('#uom14').val(BeamUOMArray[Beam]);
});

/********** Extras 6 ***********/
$('#desclist32').change(function() {        
var Beam = $(this).val();
$('#desc61').val(BeamDESCArray[Beam]); 
$('#invent61').val(BeamIDArray[Beam]); 
$('#descrrp61').val(BeamRRPArray[Beam]);
$('#desccost61').val(BeamCOSTArray[Beam]);
$('#uom15').val(BeamUOMArray[Beam]);
});


/********** Extras 7 ***********/
$('#desclist33').change(function() {        
var Beam = $(this).val();
$('#desc62').val(BeamDESCArray[Beam]); 
$('#invent62').val(BeamIDArray[Beam]); 
$('#descrrp62').val(BeamRRPArray[Beam]);
$('#desccost62').val(BeamCOSTArray[Beam]);
$('#uom16').val(BeamUOMArray[Beam]);
});


/********** Extras 8 ***********/
$('#desclist34').change(function() {        
var Beam = $(this).val();
$('#desc63').val(BeamDESCArray[Beam]); 
$('#invent63').val(BeamIDArray[Beam]); 
$('#descrrp63').val(BeamRRPArray[Beam]);
$('#desccost63').val(BeamCOSTArray[Beam]);
$('#uom17').val(BeamUOMArray[Beam]);
});


/********** Extras 9 ***********/
$('#desclist35').change(function() {        
var Beam = $(this).val();
$('#desc64').val(BeamDESCArray[Beam]); 
$('#invent64').val(BeamIDArray[Beam]); 
$('#descrrp64').val(BeamRRPArray[Beam]);
$('#desccost64').val(BeamCOSTArray[Beam]);
$('#uom18').val(BeamUOMArray[Beam]);
});


/********** Extras 10 ***********/
$('#desclist36').change(function() {        
var Beam = $(this).val();
$('#desc65').val(BeamDESCArray[Beam]); 
$('#invent65').val(BeamIDArray[Beam]); 
$('#descrrp65').val(BeamRRPArray[Beam]);
$('#desccost65').val(BeamCOSTArray[Beam]);
$('#uom19').val(BeamUOMArray[Beam]);
});



// Change TotalRRP and TotalCost on Any Input Update
var addrrp = 0;
$(".rrp").each(function() {
addrrp += Number($(this).val());
});
$("#subtotalvergolaid").val(addrrp.toFixed(2));

var addcost = 0;
$(".cst").each(function() {
addcost += Number($(this).val());
});
$("#totalcostid").val(addcost.toFixed(2));


// Change Disburment TotalRRP and TotalCost on Any Input Update
var addrrpd = 0;
$(".rrpd").each(function() {
addrrpd += Number($(this).val());
});
$("#subtotaldisdid").val(addrrpd.toFixed(2));

// Add Sales Cost
$("#salescostid").val(((addrrp  / 100) * $("#salescommid").val()).toFixed(2));

// Add Installer or Erector Cost
$("#installercostid").val(((addrrp  / 100) * $("#installercommid").val()).toFixed(2));

// Add Total Sell without GST
$("#totalrrpid").val((addrrp + addrrpd).toFixed(2));

// Add Total GST
$("#totalgstid").val((((addrrp + addrrpd) / 100) * $("#gstid").val()).toFixed(2));

// Add Total Sell with GST
var totalsell = parseFloat($('#totalrrpid').val());
var totalgst = parseFloat($('#totalgstid').val());
$("#totalrrpgstid").val((totalsell + totalgst).toFixed(2));

// Add Total Cost with GST
$("#totalcostgstid").val(((addcost  / 100) * $("#gstid").val()).toFixed(2));

/************* All Input Option Change*************/

// Set Subtotal on RRP 1 and COST 1
	
var rrpcb = parseFloat($('#descrrp1').val());
var rrpweb = parseFloat($('#webrrp1').val());
var rrppp = parseFloat($('#paintrrp1').val());
var rrplen = parseFloat($('#lengthid').val());
var rrpqty = parseFloat($('#qtylen1').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrpweb = parseFloat(rrpweb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrpweb + subrrppp) * rrpqty).toFixed(2) ;
$('#rrp1').val(subrrp);

var costcb = parseFloat($('#desccost1').val());
var costweb = parseFloat($('#webcost1').val());
var costpp = parseFloat($('#paintcost1').val());
var costlen = parseFloat($('#lengthid').val());
var costqty = parseFloat($('#qtylen1').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostweb = parseFloat(costweb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostweb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst1').val(subcost);

// Set Subtotal on RRP 2 and COST 2
var rrpcb = parseFloat($('#descrrp2').val());
var rrpweb = parseFloat($('#webrrp2').val());
var rrppp = parseFloat($('#paintrrp2').val());
var rrplen = parseFloat($('#widthid').val());
var rrpqty = parseFloat($('#qtylen2').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrpweb = parseFloat(rrpweb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrpweb + subrrppp) * rrpqty).toFixed(2) ;		   
$('#rrp2').val(subrrp);
var costcb = parseFloat($('#desccost2').val());
var costweb = parseFloat($('#webcost2').val());
var costpp = parseFloat($('#paintcost2').val());
var costlen = parseFloat($('#widthid').val());
var costqty = parseFloat($('#qtylen2').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostweb = parseFloat(costweb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostweb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst2').val(subcost);

// Set Subtotal on RRP 3 and COST 3
var rrpcb = parseFloat($('#descrrp3').val());
var rrpqty = parseFloat($('#qtylen3').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp3').val(subrrp);
var costcb = parseFloat($('#desccost3').val());
var costqty = parseFloat($('#qtylen3').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst3').val(subcost);

// Set Subtotal on RRP 4 and COST 4
var rrpcb = parseFloat($('#descrrp4').val());
var rrppp = parseFloat($('#paintrrp3').val());
var rrplen = parseFloat($('#xlength1').val());
var rrpqty = parseFloat($('#addqty1').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp4').val(subrrp);
var costcb = parseFloat($('#desccost4').val());
var costpp = parseFloat($('#paintcost3').val());
var costlen = parseFloat($('#xlength1').val());
var costqty = parseFloat($('#addqty1').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst4').val(subcost);

// Set Subtotal on RRP 5 and COST 5
var rrpcb = parseFloat($('#descrrp5').val());
var rrppp = parseFloat($('#paintrrp4').val());
var rrplen = parseFloat($('#xlength2').val());
var rrpqty = parseFloat($('#addqty2').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp5').val(subrrp);
var costcb = parseFloat($('#desccost5').val());
var costpp = parseFloat($('#paintcost4').val());
var costlen = parseFloat($('#xlength2').val());
var costqty = parseFloat($('#addqty2').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst5').val(subcost);


// Set Subtotal on RRP 6 and COST 6
var rrpcb = parseFloat($('#descrrp6').val());
var rrppp = parseFloat($('#paintrrp5').val());
var rrplen = parseFloat($('#xlength3').val());
var rrpqty = parseFloat($('#addqty3').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp6').val(subrrp);
var costcb = parseFloat($('#desccost6').val());
var costpp = parseFloat($('#paintcost5').val());
var costlen = parseFloat($('#xlength3').val());
var costqty = parseFloat($('#addqty3').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst6').val(subcost);

// Set Subtotal on RRP 7 and COST 7
var rrpcb = parseFloat($('#descrrp7').val());
var rrppp = parseFloat($('#paintrrp6').val());
var rrplen = parseFloat($('#xlength4').val());
var rrpqty = parseFloat($('#addqty4').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp7').val(subrrp);
var costcb = parseFloat($('#desccost7').val());
var costpp = parseFloat($('#paintcost6').val());
var costlen = parseFloat($('#xlength4').val());
var costqty = parseFloat($('#addqty4').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst7').val(subcost);

// Set Subtotal on RRP 8 and COST 8
var rrpcb = parseFloat($('#descrrp8').val());
var rrppp = parseFloat($('#paintrrp7').val());
var rrplen = parseFloat($('#xlength5').val());
var rrpqty = parseFloat($('#addqty5').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp8').val(subrrp);
var costcb = parseFloat($('#desccost8').val());
var costpp = parseFloat($('#paintcost7').val());
var costlen = parseFloat($('#xlength5').val());
var costqty = parseFloat($('#addqty5').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst8').val(subcost);

// Set Subtotal on RRP 9 and COST 9
var rrpcb = parseFloat($('#descrrp9').val());
var rrppp = parseFloat($('#paintrrp8').val());
var rrplen = parseFloat($('#xlength6').val());
var rrpqty = parseFloat($('#addqty6').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp9').val(subrrp);
var costcb = parseFloat($('#desccost9').val());
var costpp = parseFloat($('#paintcost8').val());
var costlen = parseFloat($('#xlength6').val());
var costqty = parseFloat($('#addqty6').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst9').val(subcost);

// Set Subtotal on RRP 10 and COST 10
var rrpcb = parseFloat($('#descrrp10').val());
var rrpqty = parseFloat($('#qtylen4').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp10').val(subrrp);
var costcb = parseFloat($('#desccost10').val());
var costqty = parseFloat($('#qtylen4').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst10').val(subcost);

// Set Subtotal on RRP 11 and COST 11
var rrpcb = parseFloat($('#descrrp11').val());
var rrpqty = parseFloat($('#qtylen5').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp11').val(subrrp);
var costcb = parseFloat($('#desccost11').val());
var costqty = parseFloat($('#qtylen5').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst11').val(subcost);

// Set Subtotal on RRP 12 and COST 12
var rrpcb = parseFloat($('#descrrp12').val());
var rrpqty = parseFloat($('#qtylen6').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp12').val(subrrp);
var costcb = parseFloat($('#desccost12').val());
var costqty = parseFloat($('#qtylen6').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst12').val(subcost);

// Set Subtotal on RRP 13 and COST 13
var rrpcb = parseFloat($('#descrrp13').val());
var rrpqty = parseFloat($('#qtylen7').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp13').val(subrrp);
var costcb = parseFloat($('#desccost13').val());
var costqty = parseFloat($('#qtylen7').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst13').val(subcost);

// Set Subtotal on RRP 14 and COST 14
var rrpcb = parseFloat($('#descrrp14').val());
var rrpqty = parseFloat($('#qtylen8').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp14').val(subrrp);
var costcb = parseFloat($('#desccost14').val());
var costqty = parseFloat($('#qtylen8').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst14').val(subcost);

// Set Subtotal on RRP 15 and COST 15
var rrpcb = parseFloat($('#descrrp15').val());
var rrpqty = parseFloat($('#qtylen9').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp15').val(subrrp);
var costcb = parseFloat($('#desccost15').val());
var costqty = parseFloat($('#qtylen9').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst15').val(subcost);

// Set Subtotal on RRP 16 and COST 16
var rrpcb = parseFloat($('#descrrp16').val());
var rrpqty = parseFloat($('#qtylen10').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp16').val(subrrp);
var costcb = parseFloat($('#desccost16').val());
var costqty = parseFloat($('#qtylen10').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst16').val(subcost);

// Set Subtotal on RRP 17 and COST 17
var rrpcb = parseFloat($('#descrrp17').val());
var rrppp = parseFloat($('#paintrrp9').val());
var rrplen = parseFloat($('#slength2').val());
var rrpqty = parseFloat($('#addqty7').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp17').val(subrrp);
var costcb = parseFloat($('#desccost17').val());
var costpp = parseFloat($('#paintcost9').val());
var costlen = parseFloat($('#slength2').val());
var costqty = parseFloat($('#addqty7').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst17').val(subcost);

// Set Subtotal on RRP 18 and COST 18
var rrpcb = parseFloat($('#descrrp18').val());
var rrppp = parseFloat($('#paintrrp10').val());
var rrplen = parseFloat($('#slength3').val());
var rrpqty = parseFloat($('#addqty8').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp18').val(subrrp);
var costcb = parseFloat($('#desccost18').val());
var costpp = parseFloat($('#paintcost10').val());
var costlen = parseFloat($('#slength3').val());
var costqty = parseFloat($('#addqty8').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst18').val(subcost);

// Set Subtotal on RRP 19 and COST 19
var rrpcb = parseFloat($('#descrrp19').val());
var rrppp = parseFloat($('#paintrrp11').val());
var rrplen = parseFloat($('#swidth2').val());
var rrpqty = parseFloat($('#addqty9').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp19').val(subrrp);
var costcb = parseFloat($('#desccost19').val());
var costpp = parseFloat($('#paintcost11').val());
var costlen = parseFloat($('#swidth2').val());
var costqty = parseFloat($('#addqty9').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst19').val(subcost);

// Set Subtotal on RRP 20 and COST 20
var rrpcb = parseFloat($('#descrrp20').val());
var rrppp = parseFloat($('#paintrrp12').val());
var rrplen = parseFloat($('#swidth3').val());
var rrpqty = parseFloat($('#addqty10').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp20').val(subrrp);
var costcb = parseFloat($('#desccost20').val());
var costpp = parseFloat($('#paintcost12').val());
var costlen = parseFloat($('#swidth3').val());
var costqty = parseFloat($('#addqty10').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst20').val(subcost);

// Set Subtotal on RRP 21 and COST 21
var rrpcb = parseFloat($('#descrrp21').val());
var rrppp = parseFloat($('#paintrrp13').val());
var rrplen = parseFloat($('#xlength7').val());
var rrpqty = parseFloat($('#addqty11').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp21').val(subrrp);
var costcb = parseFloat($('#desccost21').val());
var costpp = parseFloat($('#paintcost13').val());
var costlen = parseFloat($('#xlength7').val());
var costqty = parseFloat($('#addqty11').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst21').val(subcost);

// Set Subtotal on RRP 22 and COST 22
var rrpcb = parseFloat($('#descrrp22').val());
var rrppp = parseFloat($('#paintrrp14').val());
var rrplen = parseFloat($('#xlength8').val());
var rrpqty = parseFloat($('#addqty12').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp22').val(subrrp);
var costcb = parseFloat($('#desccost22').val());
var costpp = parseFloat($('#paintcost14').val());
var costlen = parseFloat($('#xlength8').val());
var costqty = parseFloat($('#addqty12').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst22').val(subcost);

// Set Subtotal on RRP 23 and COST 23
var rrpcb = parseFloat($('#descrrp23').val());
var rrppp = parseFloat($('#paintrrp15').val());
var rrplen = parseFloat($('#xlength9').val());
var rrpqty = parseFloat($('#addqty13').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp23').val(subrrp);
var costcb = parseFloat($('#desccost23').val());
var costpp = parseFloat($('#paintcost15').val());
var costlen = parseFloat($('#xlength9').val());
var costqty = parseFloat($('#addqty13').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst23').val(subcost);

// Set Subtotal on RRP 24 and COST 24
var rrpcb = parseFloat($('#descrrp24').val());
var rrppp = parseFloat($('#paintrrp16').val());
var rrplen = parseFloat($('#xlength10').val());
var rrpqty = parseFloat($('#addqty14').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp24').val(subrrp);
var costcb = parseFloat($('#desccost24').val());
var costpp = parseFloat($('#paintcost16').val());
var costlen = parseFloat($('#xlength10').val());
var costqty = parseFloat($('#addqty14').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst24').val(subcost);


// Set Subtotal on RRP 25 and COST 25
var rrpcb = parseFloat($('#descrrp25').val());
var rrppp = parseFloat($('#paintrrp17').val());
var rrplen = parseFloat($('#xlength11').val());
var rrpqty = parseFloat($('#addqty15').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp25').val(subrrp);
var costcb = parseFloat($('#desccost25').val());
var costpp = parseFloat($('#paintcost17').val());
var costlen = parseFloat($('#xlength11').val());
var costqty = parseFloat($('#addqty15').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst25').val(subcost);


// Set Subtotal on RRP 26 and COST 26
var rrpcb = parseFloat($('#descrrp26').val());
var rrppp = parseFloat($('#paintrrp18').val());
var rrplen = parseFloat($('#xlength12').val());
var rrpqty = parseFloat($('#addqty16').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp26').val(subrrp);
var costcb = parseFloat($('#desccost26').val());
var costpp = parseFloat($('#paintcost18').val());
var costlen = parseFloat($('#xlength12').val());
var costqty = parseFloat($('#addqty16').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst26').val(subcost);

// Set Subtotal on RRP 27 and COST 27
var rrpcb = parseFloat($('#descrrp27').val());
var rrppp = parseFloat($('#paintrrp19').val());
var rrplen = parseFloat($('#xlength13').val());
var rrpqty = parseFloat($('#addqty17').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp27').val(subrrp);
var costcb = parseFloat($('#desccost27').val());
var costpp = parseFloat($('#paintcost19').val());
var costlen = parseFloat($('#xlength13').val());
var costqty = parseFloat($('#addqty17').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst27').val(subcost);

// Set Subtotal on RRP 28 and COST 28
var rrpcb = parseFloat($('#descrrp28').val());
var rrppp = parseFloat($('#paintrrp20').val());
var rrplen = parseFloat($('#xlength14').val());
var rrpqty = parseFloat($('#addqty18').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp28').val(subrrp);
var costcb = parseFloat($('#desccost28').val());
var costpp = parseFloat($('#paintcost20').val());
var costlen = parseFloat($('#xlength14').val());
var costqty = parseFloat($('#addqty18').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst28').val(subcost);


// Set Subtotal on RRP 29 and COST 29
var rrpcb = parseFloat($('#descrrp29').val());
var rrppp = parseFloat($('#paintrrp21').val());
var rrplen = parseFloat($('#xlength15').val());
var rrpqty = parseFloat($('#addqty19').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp29').val(subrrp);
var costcb = parseFloat($('#desccost29').val());
var costpp = parseFloat($('#paintcost21').val());
var costlen = parseFloat($('#xlength15').val());
var costqty = parseFloat($('#addqty19').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst29').val(subcost);


// Set Subtotal on RRP 30 and COST 30
var rrpcb = parseFloat($('#descrrp30').val());
var rrppp = parseFloat($('#paintrrp22').val());
var rrplen = parseFloat($('#xlength16').val());
var rrpqty = parseFloat($('#addqty20').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp30').val(subrrp);
var costcb = parseFloat($('#desccost30').val());
var costpp = parseFloat($('#paintcost22').val());
var costlen = parseFloat($('#xlength16').val());
var costqty = parseFloat($('#addqty20').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst30').val(subcost);


// Set Subtotal on RRP 31 and COST 31
var rrpcb = parseFloat($('#descrrp31').val());
var rrppp = parseFloat($('#paintrrp23').val());
var rrplen = parseFloat($('#xlength17').val());
var rrpqty = parseFloat($('#addqty21').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp31').val(subrrp);
var costcb = parseFloat($('#desccost31').val());
var costpp = parseFloat($('#paintcost23').val());
var costlen = parseFloat($('#xlength17').val());
var costqty = parseFloat($('#addqty21').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst31').val(subcost);

// Set Subtotal on RRP 32 and COST 32
var rrpcb = parseFloat($('#descrrp32').val());
var rrppp = parseFloat($('#paintrrp24').val());
var rrplen = parseFloat($('#xlength18').val());
var rrpqty = parseFloat($('#addqty22').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp32').val(subrrp);
var costcb = parseFloat($('#desccost32').val());
var costpp = parseFloat($('#paintcost24').val());
var costlen = parseFloat($('#xlength18').val());
var costqty = parseFloat($('#addqty22').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst32').val(subcost);

// Set Subtotal on RRP 33 and COST 33
var rrpcb = parseFloat($('#descrrp33').val());
var rrppp = parseFloat($('#paintrrp25').val());
var rrplen = parseFloat($('#xlength19').val());
var rrpqty = parseFloat($('#addqty23').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp33').val(subrrp);
var costcb = parseFloat($('#desccost33').val());
var costpp = parseFloat($('#paintcost25').val());
var costlen = parseFloat($('#xlength19').val());
var costqty = parseFloat($('#addqty23').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst33').val(subcost);

// Set Subtotal on RRP 34 and COST 34
var rrpcb = parseFloat($('#descrrp34').val());
var rrppp = parseFloat($('#paintrrp26').val());
var rrplen = parseFloat($('#xlength20').val());
var rrpqty = parseFloat($('#qtylen11').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp34').val(subrrp);
var costcb = parseFloat($('#desccost34').val());
var costpp = parseFloat($('#paintcost26').val());
var costlen = parseFloat($('#xlength20').val());
var costqty = parseFloat($('#qtylen11').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst34').val(subcost);

// Set Subtotal on RRP 35 and COST 35
var rrpcb = parseFloat($('#descrrp35').val());
var rrppp = parseFloat($('#paintrrp27').val());
var rrplen = parseFloat($('#xlength21').val());
var rrpqty = parseFloat($('#qtylen12').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp35').val(subrrp);
var costcb = parseFloat($('#desccost35').val());
var costpp = parseFloat($('#paintcost27').val());
var costlen = parseFloat($('#xlength21').val());
var costqty = parseFloat($('#qtylen12').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst35').val(subcost);

// Set Subtotal on RRP 36 and COST 36
var rrpcb = parseFloat($('#descrrp36').val());
var rrppp = parseFloat($('#paintrrp28').val());
var rrplen = parseFloat($('#xlength22').val());
var rrpqty = parseFloat($('#qtylen13').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp36').val(subrrp);
var costcb = parseFloat($('#desccost36').val());
var costpp = parseFloat($('#paintcost28').val());
var costlen = parseFloat($('#xlength22').val());
var costqty = parseFloat($('#qtylen13').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst36').val(subcost);

// Set Subtotal on RRP 37 and COST 37
var rrpcb = parseFloat($('#descrrp37').val());
var rrppp = parseFloat($('#paintrrp29').val());
var rrplen = parseFloat($('#xlength23').val());
var rrpqty = parseFloat($('#qtylen14').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp37').val(subrrp);
var costcb = parseFloat($('#desccost37').val());
var costpp = parseFloat($('#paintcost29').val());
var costlen = parseFloat($('#xlength23').val());
var costqty = parseFloat($('#qtylen14').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst37').val(subcost);

// Set Subtotal on RRP 38 and COST 38
var rrpcb = parseFloat($('#descrrp38').val());
var rrppp = parseFloat($('#paintrrp30').val());
var rrplen = parseFloat($('#xlength24').val());
var rrpqty = parseFloat($('#qtylen15').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp38').val(subrrp);
var costcb = parseFloat($('#desccost38').val());
var costpp = parseFloat($('#paintcost30').val());
var costlen = parseFloat($('#xlength24').val());
var costqty = parseFloat($('#qtylen15').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst38').val(subcost);

// Set Subtotal on RRP 39 and COST 39
var rrpcb = parseFloat($('#descrrp39').val());
var rrppp = parseFloat($('#paintrrp31').val());
var rrplen = parseFloat($('#xlength25').val());
var rrpqty = parseFloat($('#qtylen16').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp39').val(subrrp);
var costcb = parseFloat($('#desccost39').val());
var costpp = parseFloat($('#paintcost31').val());
var costlen = parseFloat($('#xlength25').val());
var costqty = parseFloat($('#qtylen16').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst39').val(subcost);

// Set Subtotal on RRP 40 and COST 40
var rrpcb = parseFloat($('#descrrp40').val());
var rrpqty = parseFloat($('#qtylen17').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp40').val(subrrp);
var costcb = parseFloat($('#desccost40').val());
var costqty = parseFloat($('#qtylen17').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst40').val(subcost);


// Set Subtotal on RRP 41 and COST 41
var rrpcb = parseFloat($('#descrrp41').val());
var rrpqty = parseFloat($('#qtylen18').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp41').val(subrrp);
var costcb = parseFloat($('#desccost41').val());
var costqty = parseFloat($('#qtylen18').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst41').val(subcost);

// Set Subtotal on RRP 42 and COST 42
var rrpcb = parseFloat($('#descrrp42').val());
var rrpqty = parseFloat($('#qtylen19').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp42').val(subrrp);
var costcb = parseFloat($('#desccost42').val());
var costqty = parseFloat($('#qtylen19').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst42').val(subcost);

// Set Subtotal on RRP 43 and COST 43
var rrpcb = parseFloat($('#descrrp43').val());
var rrpqty = parseFloat($('#qtylen20').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp43').val(subrrp);
var costcb = parseFloat($('#desccost43').val());
var costqty = parseFloat($('#qtylen20').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst43').val(subcost);


// Set Subtotal on RRP 44 and COST 44
var rrpcb = parseFloat($('#descrrp44').val());
var rrpqty = parseFloat($('#qtylen21').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp44').val(subrrp);
var costcb = parseFloat($('#desccost44').val());
var costqty = parseFloat($('#qtylen21').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst44').val(subcost);

// Set Subtotal on RRP 45 and COST 45
var rrpcb = parseFloat($('#descrrp45').val());
var rrppp = parseFloat($('#paintrrp32').val());
var rrplen = parseFloat($('#lengthid').val());
var rrpqty = parseFloat((rrplen * 1000) / 200);
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;
$('#qtylen22').val(rrpqty);	
$('#rrp45').val(subrrp);
var costcb = parseFloat($('#desccost45').val());
var costpp = parseFloat($('#paintcost32').val());
var costlen = parseFloat($('#lengthid').val());
var costqty = parseFloat((rrplen * 1000) / 200);
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst45').val(subcost);

// Set Subtotal on RRP 46 and COST 46
var rrpcb = parseFloat($('#descrrp46').val());
var rrppp = parseFloat($('#paintrrp33').val());
var rrpqty = parseFloat($('#qtylen22').val());
var subqty = parseFloat(rrpqty * 2);
var subrrpcb = parseFloat((rrpcb + rrppp) * subqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);	
$('#qtylen23').val(subqty);			   
$('#rrp46').val(subrrp);
var costcb = parseFloat($('#desccost46').val());
var costpp = parseFloat($('#paintcost33').val());
var subcostcb = parseFloat((costcb + costpp) * subqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst46').val(subcost);

// Set Subtotal on RRP 47 and COST 47
var rrpcb = parseFloat($('#descrrp47').val());
var rrppp = parseFloat($('#paintrrp34').val());
var rrpqty = parseFloat($('#qtylen23').val());
var subqty = Math.ceil((rrpqty / 12) * 2);
var subrrpcb = parseFloat((rrpcb + rrppp) * subqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);	
$('#qtylen24').val(subqty);			   
$('#rrp47').val(subrrp);
var costcb = parseFloat($('#desccost47').val());
var costpp = parseFloat($('#paintcost34').val());
var subcostcb = parseFloat((costcb + costpp) * subqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst47').val(subcost);


// Set Subtotal on RRP 48 and COST 48
var rrpcb = parseFloat($('#descrrp48').val());
var rrppp = parseFloat($('#paintrrp35').val());
var rrpqty = parseFloat($('#qtylen24').val());
var subqty = Math.ceil(rrpqty / 2);
var subrrpcb = parseFloat((rrpcb + rrppp) * subqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);	
$('#qtylen25').val(subqty);			   
$('#rrp48').val(subrrp);
var costcb = parseFloat($('#desccost48').val());
var rrppp = parseFloat($('#paintrrp35').val());
var subcostcb = parseFloat((costcb + costpp) * subqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst48').val(subcost);

// Set Subtotal on RRP 49 and COST 49
var rrpcb = parseFloat($('#descrrp49').val());
var rrpqty = parseFloat($('#qtylen26').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp49').val(subrrp);
var costcb = parseFloat($('#desccost49').val());
var costqty = parseFloat($('#qtylen26').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst49').val(subcost);


// Set Subtotal on RRP 50 and COST 50
$('#qtylen27').focus(function() {
	$('#qtylen27').css({display: "none"});
	$('#motor').css({display: "block"});
	$('#motor').val($(this).val());
});

$('#motor').change(function() {
	$('#qtylen27').val($(this).val());
	var rrpcb = parseFloat($('#descrrp50').val());
    var rrpqty = parseFloat($('#qtylen27').val());
	var subrrpcb = parseFloat(rrpcb * rrpqty);
    var subrrp = parseFloat(subrrpcb).toFixed(2);			   
    $('#rrp50').val(subrrp);
	var costcb = parseFloat($('#desccost50').val());
    var subcostcb = parseFloat(costcb  * rrpqty);
    var subcost = parseFloat(subcostcb).toFixed(2);			   
    $('#cst50').val(subcost);
	
var addrrp = 0;
$(".rrp").each(function() {
addrrp += Number($(this).val());
});
$("#subtotalvergolaid").val(addrrp.toFixed(2));

var addcost = 0;
$(".cst").each(function() {
addcost += Number($(this).val());
});
$("#totalcostid").val(addcost.toFixed(2));
	
});

$('#lengthid').change(function() {
$('#qtylen27').css({display: "block"});
$('#motor').css({display: "none"});
var rrpcb = parseFloat($('#descrrp50').val());
var rrpqty = parseFloat($('#qtylen22').val());
var subqty = Math.ceil(rrpqty / 30);
$('#qtylen27').val(subqty);	
var subrrpcb = parseFloat(rrpcb * subqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp50').val(subrrp);
var costcb = parseFloat($('#desccost50').val());
var subcostcb = parseFloat(costcb  * subqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst50').val(subcost);
});

// Set Subtotal on RRP 51 and COST 51
var rrpcb = parseFloat($('#descrrp51').val());
var rrpqty = parseFloat($('#qtylen28').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp51').val(subrrp);
var costcb = parseFloat($('#desccost51').val());
var costqty = parseFloat($('#qtylen28').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst51').val(subcost);

// Set Subtotal on RRP 52 and COST 52
var rrpcb = parseFloat($('#descrrp52').val());
var rrpqty = parseFloat($('#qtylen29').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp52').val(subrrp);
var costcb = parseFloat($('#desccost52').val());
var costqty = parseFloat($('#qtylen29').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst52').val(subcost);

// Set Subtotal on RRP 53 and COST 53
var rrpcb = parseFloat($('#descrrp53').val());
var rrpqty = parseFloat($('#qtylen30').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp53').val(subrrp);
var costcb = parseFloat($('#desccost53').val());
var costqty = parseFloat($('#qtylen30').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst53').val(subcost);

// Set Subtotal on RRP 54 and COST 54
var rrpcb = parseFloat($('#descrrp54').val());
var rrpqty = parseFloat($('#qtylen31').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp54').val(subrrp);
var costcb = parseFloat($('#desccost54').val());
var costqty = parseFloat($('#qtylen31').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst54').val(subcost);

// Set Subtotal on RRP 55 and COST 55
var rrpcb = parseFloat($('#descrrp55').val());
var rrpqty = parseFloat($('#addqty24').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrp55').val(subrrp);
var costcb = parseFloat($('#desccost55').val());
var costqty = parseFloat($('#addqty24').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst55').val(subcost);


// Set Subtotal on RRP 56 and COST 56
var rrpcb = parseFloat($('#descrrp56').val());
var rrplen = parseFloat($('#xlength26').val());
var rrpqty = parseFloat($('#addqty25').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp56').val(subrrp);
var costcb = parseFloat($('#desccost56').val());
var costlen = parseFloat($('#xlength26').val());
var costqty = parseFloat($('#addqty25').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst56').val(subcost);

// Set Subtotal on RRP 57 and COST 57
var rrpcb = parseFloat($('#descrrp57').val());
var rrplen = parseFloat($('#xlength27').val());
var rrpqty = parseFloat($('#addqty26').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp57').val(subrrp);
var costcb = parseFloat($('#desccost57').val());
var costlen = parseFloat($('#xlength27').val());
var costqty = parseFloat($('#addqty26').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst57').val(subcost);


// Set Subtotal on RRP 58 and COST 58
var rrpcb = parseFloat($('#descrrp58').val());
var rrplen = parseFloat($('#xlength28').val());
var rrpqty = parseFloat($('#addqty27').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp58').val(subrrp);
var costcb = parseFloat($('#desccost58').val());
var costlen = parseFloat($('#xlength28').val());
var costqty = parseFloat($('#addqty27').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst58').val(subcost);


// Set Subtotal on RRP 59 and COST 59
var rrpcb = parseFloat($('#descrrp59').val());
var rrplen = parseFloat($('#xlength29').val());
var rrpqty = parseFloat($('#addqty28').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp59').val(subrrp);
var costcb = parseFloat($('#desccost59').val());
var costlen = parseFloat($('#xlength29').val());
var costqty = parseFloat($('#addqty28').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst59').val(subcost);

// Set Subtotal on RRP 60 and COST 60
var rrpcb = parseFloat($('#descrrp60').val());
var rrplen = parseFloat($('#xlength30').val());
var rrpqty = parseFloat($('#addqty29').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp60').val(subrrp);
var costcb = parseFloat($('#desccost60').val());
var costlen = parseFloat($('#xlength30').val());
var costqty = parseFloat($('#addqty29').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst60').val(subcost);

// Set Subtotal on RRP 61 and COST 61
var rrpcb = parseFloat($('#descrrp61').val());
var rrplen = parseFloat($('#xlength31').val());
var rrpqty = parseFloat($('#addqty30').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp61').val(subrrp);
var costcb = parseFloat($('#desccost61').val());
var costlen = parseFloat($('#xlength31').val());
var costqty = parseFloat($('#addqty30').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst61').val(subcost);

// Set Subtotal on RRP 62 and COST 62
var rrpcb = parseFloat($('#descrrp62').val());
var rrplen = parseFloat($('#xlength32').val());
var rrpqty = parseFloat($('#addqty31').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp62').val(subrrp);
var costcb = parseFloat($('#desccost62').val());
var costlen = parseFloat($('#xlength32').val());
var costqty = parseFloat($('#addqty31').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst62').val(subcost);

// Set Subtotal on RRP 63 and COST 63
var rrpcb = parseFloat($('#descrrp63').val());
var rrplen = parseFloat($('#xlength33').val());
var rrpqty = parseFloat($('#addqty32').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp63').val(subrrp);
var costcb = parseFloat($('#desccost63').val());
var costlen = parseFloat($('#xlength33').val());
var costqty = parseFloat($('#addqty32').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst63').val(subcost);

// Set Subtotal on RRP 64 and COST 64
var rrpcb = parseFloat($('#descrrp64').val());
var rrplen = parseFloat($('#xlength34').val());
var rrpqty = parseFloat($('#addqty33').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp64').val(subrrp);
var costcb = parseFloat($('#desccost64').val());
var costlen = parseFloat($('#xlength34').val());
var costqty = parseFloat($('#addqty33').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst64').val(subcost);

// Set Subtotal on RRP 65 and COST 65
var rrpcb = parseFloat($('#descrrp65').val());
var rrplen = parseFloat($('#xlength35').val());
var rrpqty = parseFloat($('#addqty34').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp65').val(subrrp);
var costcb = parseFloat($('#desccost65').val());
var costlen = parseFloat($('#xlength35').val());
var costqty = parseFloat($('#addqty34').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst65').val(subcost);

// Begin Disbursement
// Set Subtotal on RRPD 1 and COSTD 1
var rrpcb = parseFloat($('#descrrp66').val());
var rrpqty = parseFloat($('#qtylen32').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd1').val(subrrp);
var costcb = parseFloat($('#desccost66').val());
var costqty = parseFloat($('#qtylen32').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd1').val(subcost);


// Set Subtotal on RRPD 2 and COSTD 2
var rrpcb = parseFloat($('#descrrp67').val());
var rrpqty = parseFloat($('#qtylen33').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd2').val(subrrp);
var costcb = parseFloat($('#desccost67').val());
var costqty = parseFloat($('#qtylen33').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd2').val(subcost);

// Set Subtotal on RRPD 3 and COSTD 3
var rrpcb = parseFloat($('#descrrp68').val());
var rrpqty = parseFloat($('#qtylen34').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd3').val(subrrp);
var costcb = parseFloat($('#desccost68').val());
var costqty = parseFloat($('#qtylen34').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd3').val(subcost);


// Set Subtotal on RRPD 4 and COSTD 4
var rrpcb = parseFloat($('#descrrp69').val());
var rrpqty = parseFloat($('#qtylen35').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd4').val(subrrp);
var costcb = parseFloat($('#desccost69').val());
var costqty = parseFloat($('#qtylen35').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd4').val(subcost);


// Set Subtotal on RRPD 5 and COSTD 5
var rrpcb = parseFloat($('#descrrp70').val());
var rrpqty = parseFloat($('#qtylen36').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd5').val(subrrp);
var costcb = parseFloat($('#desccost70').val());
var costqty = parseFloat($('#qtylen36').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd5').val(subcost);

// Set Subtotal on RRPD 6 and COSTD 6
var rrpcb = parseFloat($('#descrrp71').val());
var rrpqty = parseFloat($('#qtylen37').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd6').val(subrrp);
var costcb = parseFloat($('#desccost71').val());
var costqty = parseFloat($('#qtylen37').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd6').val(subcost);

// Set Subtotal on RRPD 7 and COSTD 7
var rrpcb = parseFloat($('#descrrp72').val());
var rrpqty = parseFloat($('#qtylen38').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd7').val(subrrp);
var costcb = parseFloat($('#desccost72').val());
var costqty = parseFloat($('#qtylen38').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd7').val(subcost);

// Set Subtotal on RRPD 8 and COSTD 8
var rrpcb = parseFloat($('#descrrp73').val());
var rrpqty = parseFloat($('#qtylen39').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd8').val(subrrp);
var costcb = parseFloat($('#desccost73').val());
var costqty = parseFloat($('#qtylen39').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd8').val(subcost);

// Set Subtotal on RRPD 9 and COSTD 9
var rrpcb = parseFloat($('#descrrp74').val());
var rrpqty = parseFloat($('#qtylen40').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd9').val(subrrp);
var costcb = parseFloat($('#desccost74').val());
var costqty = parseFloat($('#qtylen40').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd9').val(subcost);

// Set Subtotal on RRPD 10 and COSTD 10
var rrpcb = parseFloat($('#descrrp75').val());
var rrpqty = parseFloat($('#qtylen41').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd10').val(subrrp);
var costcb = parseFloat($('#desccost75').val());
var costqty = parseFloat($('#qtylen41').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd10').val(subcost);

// Set Subtotal on RRPD 11 and COSTD 11
var rrpcb = parseFloat($('#descrrp76').val());
var rrpqty = parseFloat($('#qtylen42').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd11').val(subrrp);
var costcb = parseFloat($('#desccost76').val());
var costqty = parseFloat($('#qtylen42').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd11').val(subcost);

// Set Subtotal on RRPD 12 and COSTD 12
var rrpcb = parseFloat($('#descrrp77').val());
var rrpqty = parseFloat($('#qtylen43').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd12').val(subrrp);
var costcb = parseFloat($('#desccost77').val());
var costqty = parseFloat($('#qtylen43').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd12').val(subcost);

// Set Subtotal on RRPD 13 and COSTD 13
var rrpcb = parseFloat($('#descrrp78').val());
var rrpqty = parseFloat($('#qtylen44').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd13').val(subrrp);
var costcb = parseFloat($('#desccost78').val());
var costqty = parseFloat($('#qtylen44').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd13').val(subcost);

// Set Subtotal on RRPD 14 and COSTD 14
var rrpcb = parseFloat($('#descrrp79').val());
var rrpqty = parseFloat($('#qtylen45').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd14').val(subrrp);
var costcb = parseFloat($('#desccost79').val());
var costqty = parseFloat($('#qtylen45').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd14').val(subcost);

// Set Subtotal on RRPD 15 and COSTD 15
var rrpcb = parseFloat($('#descrrp80').val());
var rrpqty = parseFloat($('#qtylen46').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd15').val(subrrp);
var costcb = parseFloat($('#desccost80').val());
var costqty = parseFloat($('#qtylen46').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd15').val(subcost);

// Set Subtotal on RRPD 16 and COSTD 16
var rrpcb = parseFloat($('#descrrp81').val());
var rrpqty = parseFloat($('#qtylen47').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd16').val(subrrp);
var costcb = parseFloat($('#desccost81').val());
var costqty = parseFloat($('#qtylen47').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd16').val(subcost);

// Set Subtotal on RRPD 17 and COSTD 17
var rrpcb = parseFloat($('#descrrp82').val());
var rrpqty = parseFloat($('#qtylen48').val());
var subrrpcb = parseFloat(rrpcb * rrpqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);			   
$('#rrpd17').val(subrrp);
var costcb = parseFloat($('#desccost82').val());
var costqty = parseFloat($('#qtylen48').val());
var subcostcb = parseFloat(costcb * costqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cstd17').val(subcost);

/************* All Select Option Change*************/

$("select").change(function() {
	
// Set Subtotal on RRP 1 and COST 1	
var rrpcb = parseFloat($('#descrrp1').val());
var rrpweb = parseFloat($('#webrrp1').val());
var rrppp = parseFloat($('#paintrrp1').val());
var rrplen = parseFloat($('#lengthid').val());
var rrpqty = parseFloat($('#qtylen1').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrpweb = parseFloat(rrpweb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrpweb + subrrppp) * rrpqty).toFixed(2) ;
$('#rrp1').val(subrrp);

var costcb = parseFloat($('#desccost1').val());
var costweb = parseFloat($('#webcost1').val());
var costpp = parseFloat($('#paintcost1').val());
var costlen = parseFloat($('#lengthid').val());
var costqty = parseFloat($('#qtylen1').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostweb = parseFloat(costweb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostweb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst1').val(subcost);

// Set Subtotal on RRP 2 and COST 2
var rrpcb = parseFloat($('#descrrp2').val());
var rrpweb = parseFloat($('#webrrp2').val());
var rrppp = parseFloat($('#paintrrp2').val());
var rrplen = parseFloat($('#widthid').val());
var rrpqty = parseFloat($('#qtylen2').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrpweb = parseFloat(rrpweb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrpweb + subrrppp) * rrpqty).toFixed(2) ;		   
$('#rrp2').val(subrrp);
var costcb = parseFloat($('#desccost2').val());
var costweb = parseFloat($('#webcost2').val());
var costpp = parseFloat($('#paintcost2').val());
var costlen = parseFloat($('#widthid').val());
var costqty = parseFloat($('#qtylen2').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostweb = parseFloat(costweb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostweb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst2').val(subcost);

// Set Subtotal on RRP 4 and COST 4
var rrpcb = parseFloat($('#descrrp4').val());
var rrppp = parseFloat($('#paintrrp3').val());
var rrplen = parseFloat($('#xlength1').val());
var rrpqty = parseFloat($('#addqty1').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp4').val(subrrp);
var costcb = parseFloat($('#desccost4').val());
var costpp = parseFloat($('#paintcost3').val());
var costlen = parseFloat($('#xlength1').val());
var costqty = parseFloat($('#addqty1').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst4').val(subcost);

if ($('#invent4').val() == 'IRV107') {
	$('#xlength1').val('1');
	$('#xlength1').hide();
	}
else { 
$('#xlength1').val('4');
$('#xlength1').show();
}

// Set Subtotal on RRP 5 and COST 5
var rrpcb = parseFloat($('#descrrp5').val());
var rrppp = parseFloat($('#paintrrp4').val());
var rrplen = parseFloat($('#xlength2').val());
var rrpqty = parseFloat($('#addqty2').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp5').val(subrrp);
var costcb = parseFloat($('#desccost5').val());
var costpp = parseFloat($('#paintcost4').val());
var costlen = parseFloat($('#xlength2').val());
var costqty = parseFloat($('#addqty2').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst5').val(subcost);

if ($('#invent5').val() == 'IRV107') {
	$('#xlength2').val('1');
	$('#xlength2').hide();
	}
else { 
$('#xlength2').val($('#xlength2').val());
$('#xlength2').show();
}

// Set Subtotal on RRP 6 and COST 6
var rrpcb = parseFloat($('#descrrp6').val());
var rrppp = parseFloat($('#paintrrp5').val());
var rrplen = parseFloat($('#xlength3').val());
var rrpqty = parseFloat($('#addqty3').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp6').val(subrrp);
var costcb = parseFloat($('#desccost6').val());
var costpp = parseFloat($('#paintcost5').val());
var costlen = parseFloat($('#xlength3').val());
var costqty = parseFloat($('#addqty3').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst6').val(subcost);

if ($('#invent6').val() == 'IRV107') {
	$('#xlength3').val('1');
	$('#xlength3').hide();
	}
else { 
$('#xlength3').val($('#xlength3').val());
$('#xlength3').show();
}

// Set Subtotal on RRP 7 and COST 7
var rrpcb = parseFloat($('#descrrp7').val());
var rrppp = parseFloat($('#paintrrp6').val());
var rrplen = parseFloat($('#xlength4').val());
var rrpqty = parseFloat($('#addqty4').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp7').val(subrrp);
var costcb = parseFloat($('#desccost7').val());
var costpp = parseFloat($('#paintcost6').val());
var costlen = parseFloat($('#xlength4').val());
var costqty = parseFloat($('#addqty4').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst7').val(subcost);


if ($('#invent7').val() == 'IRV107') {
	$('#xlength4').val('1');
	$('#xlength4').hide();
	}
else { 
$('#xlength4').val($('#xlength4').val());
$('#xlength4').show();
}


// Set Subtotal on RRP 8 and COST 8
var rrpcb = parseFloat($('#descrrp8').val());
var rrppp = parseFloat($('#paintrrp7').val());
var rrplen = parseFloat($('#xlength5').val());
var rrpqty = parseFloat($('#addqty5').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp8').val(subrrp);
var costcb = parseFloat($('#desccost8').val());
var costpp = parseFloat($('#paintcost7').val());
var costlen = parseFloat($('#xlength5').val());
var costqty = parseFloat($('#addqty5').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst8').val(subcost);


if ($('#invent8').val() == 'IRV107') {
	$('#xlength5').val('1');
	$('#xlength5').hide();
	}
else { 
$('#xlength5').val($('#xlength5').val());
$('#xlength5').show();
}


// Set Subtotal on RRP 9 and COST 9
var rrpcb = parseFloat($('#descrrp9').val());
var rrppp = parseFloat($('#paintrrp8').val());
var rrplen = parseFloat($('#xlength6').val());
var rrpqty = parseFloat($('#addqty6').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp9').val(subrrp);
var costcb = parseFloat($('#desccost9').val());
var costpp = parseFloat($('#paintcost8').val());
var costlen = parseFloat($('#xlength6').val());
var costqty = parseFloat($('#addqty6').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst9').val(subcost);


if ($('#invent9').val() == 'IRV107') {
	$('#xlength6').val('1');
	$('#xlength6').hide();
	}
else { 
$('#xlength6').val($('#xlength6').val());
$('#xlength6').show();
}

// Set Subtotal on RRP 17 and COST 17
var rrpcb = parseFloat($('#descrrp17').val());
var rrppp = parseFloat($('#paintrrp9').val());
var rrplen = parseFloat($('#slength2').val());
var rrpqty = parseFloat($('#addqty7').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp17').val(subrrp);
var costcb = parseFloat($('#desccost17').val());
var costpp = parseFloat($('#paintcost9').val());
var costlen = parseFloat($('#slength2').val());
var costqty = parseFloat($('#addqty7').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst17').val(subcost);

// Set Subtotal on RRP 18 and COST 18
var rrpcb = parseFloat($('#descrrp18').val());
var rrppp = parseFloat($('#paintrrp10').val());
var rrplen = parseFloat($('#slength3').val());
var rrpqty = parseFloat($('#addqty8').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp18').val(subrrp);
var costcb = parseFloat($('#desccost18').val());
var costpp = parseFloat($('#paintcost10').val());
var costlen = parseFloat($('#slength3').val());
var costqty = parseFloat($('#addqty8').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst18').val(subcost);

// Set Subtotal on RRP 19 and COST 19
var rrpcb = parseFloat($('#descrrp19').val());
var rrppp = parseFloat($('#paintrrp11').val());
var rrplen = parseFloat($('#swidth2').val());
var rrpqty = parseFloat($('#addqty9').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp19').val(subrrp);
var costcb = parseFloat($('#desccost19').val());
var costpp = parseFloat($('#paintcost11').val());
var costlen = parseFloat($('#swidth2').val());
var costqty = parseFloat($('#addqty9').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst19').val(subcost);

// Set Subtotal on RRP 20 and COST 20
var rrpcb = parseFloat($('#descrrp20').val());
var rrppp = parseFloat($('#paintrrp12').val());
var rrplen = parseFloat($('#swidth3').val());
var rrpqty = parseFloat($('#addqty10').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp20').val(subrrp);
var costcb = parseFloat($('#desccost20').val());
var costpp = parseFloat($('#paintcost12').val());
var costlen = parseFloat($('#swidth3').val());
var costqty = parseFloat($('#addqty10').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst20').val(subcost);

// Set Subtotal on RRP 21 and COST 21
var rrpcb = parseFloat($('#descrrp21').val());
var rrppp = parseFloat($('#paintrrp13').val());
var rrplen = parseFloat($('#xlength7').val());
var rrpqty = parseFloat($('#addqty11').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp21').val(subrrp);
var costcb = parseFloat($('#desccost21').val());
var costpp = parseFloat($('#paintcost13').val());
var costlen = parseFloat($('#xlength7').val());
var costqty = parseFloat($('#addqty11').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst21').val(subcost);

// Set Subtotal on RRP 22 and COST 22
var rrpcb = parseFloat($('#descrrp22').val());
var rrppp = parseFloat($('#paintrrp14').val());
var rrplen = parseFloat($('#xlength8').val());
var rrpqty = parseFloat($('#addqty12').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp22').val(subrrp);
var costcb = parseFloat($('#desccost22').val());
var costpp = parseFloat($('#paintcost14').val());
var costlen = parseFloat($('#xlength8').val());
var costqty = parseFloat($('#addqty12').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst22').val(subcost);

// Set Subtotal on RRP 23 and COST 23
var rrpcb = parseFloat($('#descrrp23').val());
var rrppp = parseFloat($('#paintrrp15').val());
var rrplen = parseFloat($('#xlength9').val());
var rrpqty = parseFloat($('#addqty13').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp23').val(subrrp);
var costcb = parseFloat($('#desccost23').val());
var costpp = parseFloat($('#paintcost15').val());
var costlen = parseFloat($('#xlength9').val());
var costqty = parseFloat($('#addqty13').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst23').val(subcost);

// Set Subtotal on RRP 24 and COST 24
var rrpcb = parseFloat($('#descrrp24').val());
var rrppp = parseFloat($('#paintrrp16').val());
var rrplen = parseFloat($('#xlength10').val());
var rrpqty = parseFloat($('#addqty14').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp24').val(subrrp);
var costcb = parseFloat($('#desccost24').val());
var costpp = parseFloat($('#paintcost16').val());
var costlen = parseFloat($('#xlength10').val());
var costqty = parseFloat($('#addqty14').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst24').val(subcost);


// Set Subtotal on RRP 25 and COST 25
var rrpcb = parseFloat($('#descrrp25').val());
var rrppp = parseFloat($('#paintrrp17').val());
var rrplen = parseFloat($('#xlength11').val());
var rrpqty = parseFloat($('#addqty15').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp25').val(subrrp);
var costcb = parseFloat($('#desccost25').val());
var costpp = parseFloat($('#paintcost17').val());
var costlen = parseFloat($('#xlength11').val());
var costqty = parseFloat($('#addqty15').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst25').val(subcost);

if ($('#invent25').val() == 'IRV37') {
	$('#xlength11').val('1');
	$('#xlength11').hide();
	}
else { 
$('#xlength11').val($('#xlength11').val());
$('#xlength11').show();
}


// Set Subtotal on RRP 26 and COST 26
var rrpcb = parseFloat($('#descrrp26').val());
var rrppp = parseFloat($('#paintrrp18').val());
var rrplen = parseFloat($('#xlength12').val());
var rrpqty = parseFloat($('#addqty16').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp26').val(subrrp);
var costcb = parseFloat($('#desccost26').val());
var costpp = parseFloat($('#paintcost18').val());
var costlen = parseFloat($('#xlength12').val());
var costqty = parseFloat($('#addqty16').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst26').val(subcost);

if ($('#invent26').val() == 'IRV37') {
	$('#xlength12').val('1');
	$('#xlength12').hide();
	}
else { 
$('#xlength12').val($('#xlength12').val());
$('#xlength12').show();
}

// Set Subtotal on RRP 27 and COST 27
var rrpcb = parseFloat($('#descrrp27').val());
var rrppp = parseFloat($('#paintrrp19').val());
var rrplen = parseFloat($('#xlength13').val());
var rrpqty = parseFloat($('#addqty17').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp27').val(subrrp);
var costcb = parseFloat($('#desccost27').val());
var costpp = parseFloat($('#paintcost19').val());
var costlen = parseFloat($('#xlength13').val());
var costqty = parseFloat($('#addqty17').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst27').val(subcost);

if ($('#invent27').val() == 'IRV37') {
	$('#xlength13').val('1');
	$('#xlength13').hide();
	}
else { 
$('#xlength13').val($('#xlength13').val());
$('#xlength13').show();
}

// Set Subtotal on RRP 28 and COST 28
var rrpcb = parseFloat($('#descrrp28').val());
var rrppp = parseFloat($('#paintrrp20').val());
var rrplen = parseFloat($('#xlength14').val());
var rrpqty = parseFloat($('#addqty18').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp28').val(subrrp);
var costcb = parseFloat($('#desccost28').val());
var costpp = parseFloat($('#paintcost20').val());
var costlen = parseFloat($('#xlength14').val());
var costqty = parseFloat($('#addqty18').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst28').val(subcost);

if ($('#invent28').val() == 'IRV37') {
	$('#xlength14').val('1');
	$('#xlength14').hide();
	}
else { 
$('#xlength14').val($('#xlength14').val());
$('#xlength14').show();
}

// Set Subtotal on RRP 29 and COST 29
var rrpcb = parseFloat($('#descrrp29').val());
var rrppp = parseFloat($('#paintrrp21').val());
var rrplen = parseFloat($('#xlength15').val());
var rrpqty = parseFloat($('#addqty19').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp29').val(subrrp);
var costcb = parseFloat($('#desccost29').val());
var costpp = parseFloat($('#paintcost21').val());
var costlen = parseFloat($('#xlength15').val());
var costqty = parseFloat($('#addqty19').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst29').val(subcost);


if ($('#invent29').val() == 'IRV37') {
	$('#xlength15').val('1');
	$('#xlength15').hide();
	}
else { 
$('#xlength15').val($('#xlength15').val());
$('#xlength15').show();
}

// Set Subtotal on RRP 30 and COST 30
var rrpcb = parseFloat($('#descrrp30').val());
var rrppp = parseFloat($('#paintrrp22').val());
var rrplen = parseFloat($('#xlength16').val());
var rrpqty = parseFloat($('#addqty20').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp30').val(subrrp);
var costcb = parseFloat($('#desccost30').val());
var costpp = parseFloat($('#paintcost22').val());
var costlen = parseFloat($('#xlength16').val());
var costqty = parseFloat($('#addqty20').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst30').val(subcost);


if ($('#invent30').val() == 'IRV37') {
	$('#xlength16').val('1');
	$('#xlength16').hide();
	}
else { 
$('#xlength16').val($('#xlength16').val());
$('#xlength16').show();
}

// Set Subtotal on RRP 31 and COST 31
var rrpcb = parseFloat($('#descrrp31').val());
var rrppp = parseFloat($('#paintrrp23').val());
var rrplen = parseFloat($('#xlength17').val());
var rrpqty = parseFloat($('#addqty21').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp31').val(subrrp);
var costcb = parseFloat($('#desccost31').val());
var costpp = parseFloat($('#paintcost23').val());
var costlen = parseFloat($('#xlength17').val());
var costqty = parseFloat($('#addqty21').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst31').val(subcost);


if ($('#invent31').val() == 'IRV37') {
	$('#xlength17').val('1');
	$('#xlength17').hide();
	}
else { 
$('#xlength17').val($('#xlength17').val());
$('#xlength17').show();
}

// Set Subtotal on RRP 32 and COST 32
var rrpcb = parseFloat($('#descrrp32').val());
var rrppp = parseFloat($('#paintrrp24').val());
var rrplen = parseFloat($('#xlength18').val());
var rrpqty = parseFloat($('#addqty22').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp32').val(subrrp);
var costcb = parseFloat($('#desccost32').val());
var costpp = parseFloat($('#paintcost24').val());
var costlen = parseFloat($('#xlength18').val());
var costqty = parseFloat($('#addqty22').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst32').val(subcost);


if ($('#invent32').val() == 'IRV37') {
	$('#xlength18').val('1');
	$('#xlength18').hide();
	}
else { 
$('#xlength18').val($('#xlength18').val());
$('#xlength18').show();
}



// Set Subtotal on RRP 33 and COST 33
var rrpcb = parseFloat($('#descrrp33').val());
var rrppp = parseFloat($('#paintrrp25').val());
var rrplen = parseFloat($('#xlength19').val());
var rrpqty = parseFloat($('#addqty23').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp33').val(subrrp);
var costcb = parseFloat($('#desccost33').val());
var costpp = parseFloat($('#paintcost25').val());
var costlen = parseFloat($('#xlength19').val());
var costqty = parseFloat($('#addqty23').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst33').val(subcost);

if ($('#invent33').val() == 'IRV37') {
	$('#xlength19').val('1');
	$('#xlength19').hide();
	}
else { 
$('#xlength19').val($('#xlength19').val());
$('#xlength19').show();
}

// Set Subtotal on RRP 34 and COST 34
var rrpcb = parseFloat($('#descrrp34').val());
var rrppp = parseFloat($('#paintrrp26').val());
var rrplen = parseFloat($('#xlength20').val());
var rrpqty = parseFloat($('#qtylen11').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp34').val(subrrp);
var costcb = parseFloat($('#desccost34').val());
var costpp = parseFloat($('#paintcost26').val());
var costlen = parseFloat($('#xlength20').val());
var costqty = parseFloat($('#qtylen11').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst34').val(subcost);

// Set Subtotal on RRP 35 and COST 35
var rrpcb = parseFloat($('#descrrp35').val());
var rrppp = parseFloat($('#paintrrp27').val());
var rrplen = parseFloat($('#xlength21').val());
var rrpqty = parseFloat($('#qtylen12').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp35').val(subrrp);
var costcb = parseFloat($('#desccost35').val());
var costpp = parseFloat($('#paintcost27').val());
var costlen = parseFloat($('#xlength21').val());
var costqty = parseFloat($('#qtylen12').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst35').val(subcost);

// Set Subtotal on RRP 36 and COST 36
var rrpcb = parseFloat($('#descrrp36').val());
var rrppp = parseFloat($('#paintrrp28').val());
var rrplen = parseFloat($('#xlength22').val());
var rrpqty = parseFloat($('#qtylen13').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp36').val(subrrp);
var costcb = parseFloat($('#desccost36').val());
var costpp = parseFloat($('#paintcost28').val());
var costlen = parseFloat($('#xlength22').val());
var costqty = parseFloat($('#qtylen13').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst36').val(subcost);

// Set Subtotal on RRP 37 and COST 37
var rrpcb = parseFloat($('#descrrp37').val());
var rrppp = parseFloat($('#paintrrp29').val());
var rrplen = parseFloat($('#xlength23').val());
var rrpqty = parseFloat($('#qtylen14').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp37').val(subrrp);
var costcb = parseFloat($('#desccost37').val());
var costpp = parseFloat($('#paintcost29').val());
var costlen = parseFloat($('#xlength23').val());
var costqty = parseFloat($('#qtylen14').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst37').val(subcost);

// Set Subtotal on RRP 38 and COST 38
var rrpcb = parseFloat($('#descrrp38').val());
var rrppp = parseFloat($('#paintrrp30').val());
var rrplen = parseFloat($('#xlength24').val());
var rrpqty = parseFloat($('#qtylen15').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp38').val(subrrp);
var costcb = parseFloat($('#desccost38').val());
var costpp = parseFloat($('#paintcost30').val());
var costlen = parseFloat($('#xlength24').val());
var costqty = parseFloat($('#qtylen15').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst38').val(subcost);

// Set Subtotal on RRP 39 and COST 39
var rrpcb = parseFloat($('#descrrp39').val());
var rrppp = parseFloat($('#paintrrp31').val());
var rrplen = parseFloat($('#xlength25').val());
var rrpqty = parseFloat($('#qtylen16').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;			   
$('#rrp39').val(subrrp);
var costcb = parseFloat($('#desccost39').val());
var costpp = parseFloat($('#paintcost31').val());
var costlen = parseFloat($('#xlength25').val());
var costqty = parseFloat($('#qtylen16').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;			   
$('#cst39').val(subcost);

// Set Subtotal on RRP 45 and COST 45
var rrpcb = parseFloat($('#descrrp45').val());
var rrppp = parseFloat($('#paintrrp32').val());
var rrplen = parseFloat($('#lengthid').val());
var rrpqty = parseFloat((rrplen * 1000) / 200);
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;
$('#qtylen22').val(rrpqty);	
$('#rrp45').val(subrrp);
var costcb = parseFloat($('#desccost45').val());
var costpp = parseFloat($('#paintcost32').val());
var costlen = parseFloat($('#lengthid').val());
var costqty = parseFloat((rrplen * 1000) / 200);
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst45').val(subcost);

// Set Subtotal on RRP 46 and COST 46
var rrpcb = parseFloat($('#descrrp46').val());
var rrppp = parseFloat($('#paintrrp33').val());
var rrpqty = parseFloat($('#qtylen22').val());
var subqty = parseFloat(rrpqty * 2);
var subrrpcb = parseFloat((rrpcb + rrppp) * subqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);	
$('#qtylen23').val(subqty);			   
$('#rrp46').val(subrrp);
var costcb = parseFloat($('#desccost46').val());
var costpp = parseFloat($('#paintcost33').val());
var subcostcb = parseFloat((costcb + costpp)  * subqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst46').val(subcost);

// Set Subtotal on RRP 47 and COST 47
var rrpcb = parseFloat($('#descrrp47').val());
var rrppp = parseFloat($('#paintrrp34').val());
var rrpqty = parseFloat($('#qtylen23').val());
var subqty = Math.ceil((rrpqty / 12) * 2);
var subrrpcb = parseFloat((rrpcb + rrppp) * subqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);	
$('#qtylen24').val(subqty);			   
$('#rrp47').val(subrrp);
var costcb = parseFloat($('#desccost47').val());
var costpp = parseFloat($('#paintcost34').val());
var subcostcb = parseFloat((costcb + costpp) * subqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst47').val(subcost);


// Set Subtotal on RRP 48 and COST 48
var rrpcb = parseFloat($('#descrrp48').val());
var rrppp = parseFloat($('#paintrrp35').val());
var rrpqty = parseFloat($('#qtylen24').val());
var subqty = Math.ceil(rrpqty / 2);
var subrrpcb = parseFloat((rrpcb + rrppp) * subqty);
var subrrp = parseFloat(subrrpcb).toFixed(2);	
$('#qtylen25').val(subqty);			   
$('#rrp48').val(subrrp);
var costcb = parseFloat($('#desccost48').val());
var rrppp = parseFloat($('#paintrrp35').val());
var subcostcb = parseFloat((costcb + costpp) * subqty);
var subcost = parseFloat(subcostcb).toFixed(2);			   
$('#cst48').val(subcost);

// Set Subtotal on RRP 56 and COST 56
var rrpcb = parseFloat($('#descrrp56').val());
var rrplen = parseFloat($('#xlength26').val());
var rrpqty = parseFloat($('#addqty25').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp56').val(subrrp);
var costcb = parseFloat($('#desccost56').val());
var costlen = parseFloat($('#xlength26').val());
var costqty = parseFloat($('#addqty25').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst56').val(subcost);

if ($('#invent56').val() == 'IRV76') {
	$('#xlength26').show();
	$('#xlength26').val($('#xlength26').val());
	}
else { 
$('#xlength26').val('1');
$('#xlength26').hide();
}
	
// Set Subtotal on RRP 57 and COST 57
var rrpcb = parseFloat($('#descrrp57').val());
var rrplen = parseFloat($('#xlength27').val());
var rrpqty = parseFloat($('#addqty26').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp57').val(subrrp);
var costcb = parseFloat($('#desccost57').val());
var costlen = parseFloat($('#xlength27').val());
var costqty = parseFloat($('#addqty26').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst57').val(subcost);

if ($('#invent57').val() == 'IRV76') {
	$('#xlength27').show();
	$('#xlength27').val($('#xlength27').val());
	}
else { 
$('#xlength27').val('1');
$('#xlength27').hide();
}

// Set Subtotal on RRP 58 and COST 58
var rrpcb = parseFloat($('#descrrp58').val());
var rrplen = parseFloat($('#xlength28').val());
var rrpqty = parseFloat($('#addqty27').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp58').val(subrrp);
var costcb = parseFloat($('#desccost58').val());
var costlen = parseFloat($('#xlength28').val());
var costqty = parseFloat($('#addqty27').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst58').val(subcost);

if ($('#invent58').val() == 'IRV76') {
	$('#xlength28').show();
	$('#xlength28').val($('#xlength28').val());
	}
else { 
$('#xlength28').val('1');
$('#xlength28').hide();
}

// Set Subtotal on RRP 59 and COST 59
var rrpcb = parseFloat($('#descrrp59').val());
var rrplen = parseFloat($('#xlength29').val());
var rrpqty = parseFloat($('#addqty28').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp59').val(subrrp);
var costcb = parseFloat($('#desccost59').val());
var costlen = parseFloat($('#xlength29').val());
var costqty = parseFloat($('#addqty28').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst59').val(subcost);

if ($('#invent59').val() == 'IRV76') {
	$('#xlength29').show();
	$('#xlength29').val($('#xlength29').val());
	}
else { 
$('#xlength29').val('1');
$('#xlength29').hide();
}

// Set Subtotal on RRP 60 and COST 60
var rrpcb = parseFloat($('#descrrp60').val());
var rrplen = parseFloat($('#xlength30').val());
var rrpqty = parseFloat($('#addqty29').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp60').val(subrrp);
var costcb = parseFloat($('#desccost60').val());
var costlen = parseFloat($('#xlength30').val());
var costqty = parseFloat($('#addqty29').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst60').val(subcost);

if ($('#invent60').val() == 'IRV76') {
	$('#xlength30').show();
	$('#xlength30').val($('#xlength30').val());
	}
else { 
$('#xlength30').val('1');
$('#xlength30').hide();
}

// Set Subtotal on RRP 61 and COST 61
var rrpcb = parseFloat($('#descrrp61').val());
var rrplen = parseFloat($('#xlength31').val());
var rrpqty = parseFloat($('#addqty30').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp61').val(subrrp);
var costcb = parseFloat($('#desccost61').val());
var costlen = parseFloat($('#xlength31').val());
var costqty = parseFloat($('#addqty30').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst61').val(subcost);

if ($('#invent61').val() == 'IRV76') {
	$('#xlength31').show();
	$('#xlength31').val($('#xlength31').val());
	}
else { 
$('#xlength31').val('1');
$('#xlength31').hide();
}

// Set Subtotal on RRP 62 and COST 62
var rrpcb = parseFloat($('#descrrp62').val());
var rrplen = parseFloat($('#xlength32').val());
var rrpqty = parseFloat($('#addqty31').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp62').val(subrrp);
var costcb = parseFloat($('#desccost62').val());
var costlen = parseFloat($('#xlength32').val());
var costqty = parseFloat($('#addqty31').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst62').val(subcost);

if ($('#invent62').val() == 'IRV76') {
	$('#xlength32').show();
	$('#xlength32').val($('#xlength32').val());
	}
else { 
$('#xlength32').val('1');
$('#xlength32').hide();
}

// Set Subtotal on RRP 63 and COST 63
var rrpcb = parseFloat($('#descrrp63').val());
var rrplen = parseFloat($('#xlength33').val());
var rrpqty = parseFloat($('#addqty32').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp63').val(subrrp);
var costcb = parseFloat($('#desccost63').val());
var costlen = parseFloat($('#xlength33').val());
var costqty = parseFloat($('#addqty32').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst63').val(subcost);

if ($('#invent63').val() == 'IRV76') {
	$('#xlength33').show();
	$('#xlength33').val($('#xlength33').val());
	}
else { 
$('#xlength33').val('1');
$('#xlength33').hide();
}


// Set Subtotal on RRP 64 and COST 64
var rrpcb = parseFloat($('#descrrp64').val());
var rrplen = parseFloat($('#xlength34').val());
var rrpqty = parseFloat($('#addqty33').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp64').val(subrrp);
var costcb = parseFloat($('#desccost64').val());
var costlen = parseFloat($('#xlength34').val());
var costqty = parseFloat($('#addqty33').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst64').val(subcost);

if ($('#invent64').val() == 'IRV76') {
	$('#xlength34').show();
	$('#xlength34').val($('#xlength34').val());
	}
else { 
$('#xlength34').val('1');
$('#xlength34').hide();
}

// Set Subtotal on RRP 65 and COST 65
var rrpcb = parseFloat($('#descrrp65').val());
var rrplen = parseFloat($('#xlength35').val());
var rrpqty = parseFloat($('#addqty34').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp65').val(subrrp);
var costcb = parseFloat($('#desccost65').val());
var costlen = parseFloat($('#xlength35').val());
var costqty = parseFloat($('#addqty34').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst65').val(subcost);	


if ($('#invent65').val() == 'IRV76') {
	$('#xlength35').show();
	$('#xlength35').val($('#xlength35').val());
	}
else { 
$('#xlength35').val('1');
$('#xlength35').hide();
}
	
// Calculate Total RRP and COST

	
var addrrp = 0;
$(".rrp").each(function() {
addrrp += Number($(this).val());
});
$("#subtotalvergolaid").val(addrrp.toFixed(2));

var addcost = 0;
$(".cst").each(function() {
addcost += Number($(this).val());
});
$("#totalcostid").val(addcost.toFixed(2));

// Add Sales Cost
$("#salescostid").val(((addrrp  / 100) * $("#salescommid").val()).toFixed(2));

// Add Installer or Erector Cost
$("#installercostid").val(((addrrp  / 100) * $("#installercommid").val()).toFixed(2));

// Add Total Sell without GST
$("#totalrrpid").val((addrrp + addrrpd).toFixed(2));

// Add Total GST
$("#totalgstid").val((((addrrp + addrrpd) / 100) * $("#gstid").val()).toFixed(2));

// Add Total Sell with GST
var totalsell = parseFloat($('#totalrrpid').val());
var totalgst = parseFloat($('#totalgstid').val());
$("#totalrrpgstid").val((totalsell + totalgst).toFixed(2));

// Add Total Cost with GST
$("#totalcostgstid").val(((addcost  / 100) * $("#gstid").val()).toFixed(2));

});

/**** On Any Button Click ********/

$(':button').on( "click", function() {
// Set Subtotal on RRP 1 and COST 1	
var rrpcb = parseFloat($('#descrrp1').val());
var rrpweb = parseFloat($('#webrrp1').val());
var rrppp = parseFloat($('#paintrrp1').val());
var rrplen = parseFloat($('#lengthid').val());
var rrpqty = parseFloat($('#qtylen1').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrpweb = parseFloat(rrpweb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrpweb + subrrppp) * rrpqty).toFixed(2) ;
$('#rrp1').val(subrrp);

var costcb = parseFloat($('#desccost1').val());
var costweb = parseFloat($('#webcost1').val());
var costpp = parseFloat($('#paintcost1').val());
var costlen = parseFloat($('#lengthid').val());
var costqty = parseFloat($('#qtylen1').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostweb = parseFloat(costweb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostweb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst1').val(subcost);

// Set Subtotal on RRP 2 and COST 2
var rrpcb = parseFloat($('#descrrp2').val());
var rrpweb = parseFloat($('#webrrp2').val());
var rrppp = parseFloat($('#paintrrp2').val());
var rrplen = parseFloat($('#widthid').val());
var rrpqty = parseFloat($('#qtylen2').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrpweb = parseFloat(rrpweb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrpweb + subrrppp) * rrpqty).toFixed(2) ;		   
$('#rrp2').val(subrrp);
var costcb = parseFloat($('#desccost2').val());
var costweb = parseFloat($('#webcost2').val());
var costpp = parseFloat($('#paintcost2').val());
var costlen = parseFloat($('#widthid').val());
var costqty = parseFloat($('#qtylen2').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostweb = parseFloat(costweb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostweb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst2').val(subcost);

// Set Subtotal on RRP 4 and COST 4
var rrpcb = parseFloat($('#descrrp4').val());
var rrppp = parseFloat($('#paintrrp3').val());
var rrplen = parseFloat($('#xlength1').val());
var rrpqty = parseFloat($('#addqty1').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp4').val(subrrp);
var costcb = parseFloat($('#desccost4').val());
var costpp = parseFloat($('#paintcost3').val());
var costlen = parseFloat($('#xlength1').val());
var costqty = parseFloat($('#addqty1').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst4').val(subcost);

if ($('#invent4').val() == 'IRV107') {
	$('#xlength1').val('1');
	$('#xlength1').hide();
	}
else { 
$('#xlength1').val('4');
$('#xlength1').show();
}

// Set Subtotal on RRP 5 and COST 5
var rrpcb = parseFloat($('#descrrp5').val());
var rrppp = parseFloat($('#paintrrp4').val());
var rrplen = parseFloat($('#xlength2').val());
var rrpqty = parseFloat($('#addqty2').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp5').val(subrrp);
var costcb = parseFloat($('#desccost5').val());
var costpp = parseFloat($('#paintcost4').val());
var costlen = parseFloat($('#xlength2').val());
var costqty = parseFloat($('#addqty2').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst5').val(subcost);

if ($('#invent5').val() == 'IRV107') {
	$('#xlength2').val('1');
	$('#xlength2').hide();
	}
else { 
$('#xlength2').val($('#xlength2').val());
$('#xlength2').show();
}

// Set Subtotal on RRP 6 and COST 6
var rrpcb = parseFloat($('#descrrp6').val());
var rrppp = parseFloat($('#paintrrp5').val());
var rrplen = parseFloat($('#xlength3').val());
var rrpqty = parseFloat($('#addqty3').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp6').val(subrrp);
var costcb = parseFloat($('#desccost6').val());
var costpp = parseFloat($('#paintcost5').val());
var costlen = parseFloat($('#xlength3').val());
var costqty = parseFloat($('#addqty3').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst6').val(subcost);

if ($('#invent6').val() == 'IRV107') {
	$('#xlength3').val('1');
	$('#xlength3').hide();
	}
else { 
$('#xlength3').val($('#xlength3').val());
$('#xlength3').show();
}

// Set Subtotal on RRP 7 and COST 7
var rrpcb = parseFloat($('#descrrp7').val());
var rrppp = parseFloat($('#paintrrp6').val());
var rrplen = parseFloat($('#xlength4').val());
var rrpqty = parseFloat($('#addqty4').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp7').val(subrrp);
var costcb = parseFloat($('#desccost7').val());
var costpp = parseFloat($('#paintcost6').val());
var costlen = parseFloat($('#xlength4').val());
var costqty = parseFloat($('#addqty4').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst7').val(subcost);


if ($('#invent7').val() == 'IRV107') {
	$('#xlength4').val('1');
	$('#xlength4').hide();
	}
else { 
$('#xlength4').val($('#xlength4').val());
$('#xlength4').show();
}


// Set Subtotal on RRP 8 and COST 8
var rrpcb = parseFloat($('#descrrp8').val());
var rrppp = parseFloat($('#paintrrp7').val());
var rrplen = parseFloat($('#xlength5').val());
var rrpqty = parseFloat($('#addqty5').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp8').val(subrrp);
var costcb = parseFloat($('#desccost8').val());
var costpp = parseFloat($('#paintcost7').val());
var costlen = parseFloat($('#xlength5').val());
var costqty = parseFloat($('#addqty5').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst8').val(subcost);


if ($('#invent8').val() == 'IRV107') {
	$('#xlength5').val('1');
	$('#xlength5').hide();
	}
else { 
$('#xlength5').val($('#xlength5').val());
$('#xlength5').show();
}


// Set Subtotal on RRP 9 and COST 9
var rrpcb = parseFloat($('#descrrp9').val());
var rrppp = parseFloat($('#paintrrp8').val());
var rrplen = parseFloat($('#xlength6').val());
var rrpqty = parseFloat($('#addqty6').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp9').val(subrrp);
var costcb = parseFloat($('#desccost9').val());
var costpp = parseFloat($('#paintcost8').val());
var costlen = parseFloat($('#xlength6').val());
var costqty = parseFloat($('#addqty6').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst9').val(subcost);


if ($('#invent9').val() == 'IRV107') {
	$('#xlength6').val('1');
	$('#xlength6').hide();
	}
else { 
$('#xlength6').val($('#xlength6').val());
$('#xlength6').show();
}


// Set Subtotal on RRP 17 and COST 17
var rrpcb = parseFloat($('#descrrp17').val());
var rrppp = parseFloat($('#paintrrp9').val());
var rrplen = parseFloat($('#slength2').val());
var rrpqty = parseFloat($('#addqty7').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp17').val(subrrp);
var costcb = parseFloat($('#desccost17').val());
var costpp = parseFloat($('#paintcost9').val());
var costlen = parseFloat($('#slength2').val());
var costqty = parseFloat($('#addqty7').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst17').val(subcost);

// Set Subtotal on RRP 18 and COST 18
var rrpcb = parseFloat($('#descrrp18').val());
var rrppp = parseFloat($('#paintrrp10').val());
var rrplen = parseFloat($('#slength3').val());
var rrpqty = parseFloat($('#addqty8').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp18').val(subrrp);
var costcb = parseFloat($('#desccost18').val());
var costpp = parseFloat($('#paintcost10').val());
var costlen = parseFloat($('#slength3').val());
var costqty = parseFloat($('#addqty8').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst18').val(subcost);

// Set Subtotal on RRP 19 and COST 19
var rrpcb = parseFloat($('#descrrp19').val());
var rrppp = parseFloat($('#paintrrp11').val());
var rrplen = parseFloat($('#swidth2').val());
var rrpqty = parseFloat($('#addqty9').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp19').val(subrrp);
var costcb = parseFloat($('#desccost19').val());
var costpp = parseFloat($('#paintcost11').val());
var costlen = parseFloat($('#swidth2').val());
var costqty = parseFloat($('#addqty9').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst19').val(subcost);

// Set Subtotal on RRP 20 and COST 20
var rrpcb = parseFloat($('#descrrp20').val());
var rrppp = parseFloat($('#paintrrp12').val());
var rrplen = parseFloat($('#swidth3').val());
var rrpqty = parseFloat($('#addqty10').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp20').val(subrrp);
var costcb = parseFloat($('#desccost20').val());
var costpp = parseFloat($('#paintcost12').val());
var costlen = parseFloat($('#swidth3').val());
var costqty = parseFloat($('#addqty10').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst20').val(subcost);

// Set Subtotal on RRP 21 and COST 21
var rrpcb = parseFloat($('#descrrp21').val());
var rrppp = parseFloat($('#paintrrp13').val());
var rrplen = parseFloat($('#xlength7').val());
var rrpqty = parseFloat($('#addqty11').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp21').val(subrrp);
var costcb = parseFloat($('#desccost21').val());
var costpp = parseFloat($('#paintcost13').val());
var costlen = parseFloat($('#xlength7').val());
var costqty = parseFloat($('#addqty11').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst21').val(subcost);

// Set Subtotal on RRP 22 and COST 22
var rrpcb = parseFloat($('#descrrp22').val());
var rrppp = parseFloat($('#paintrrp14').val());
var rrplen = parseFloat($('#xlength8').val());
var rrpqty = parseFloat($('#addqty12').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp22').val(subrrp);
var costcb = parseFloat($('#desccost22').val());
var costpp = parseFloat($('#paintcost14').val());
var costlen = parseFloat($('#xlength8').val());
var costqty = parseFloat($('#addqty12').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst22').val(subcost);

// Set Subtotal on RRP 23 and COST 23
var rrpcb = parseFloat($('#descrrp23').val());
var rrppp = parseFloat($('#paintrrp15').val());
var rrplen = parseFloat($('#xlength9').val());
var rrpqty = parseFloat($('#addqty13').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp23').val(subrrp);
var costcb = parseFloat($('#desccost23').val());
var costpp = parseFloat($('#paintcost15').val());
var costlen = parseFloat($('#xlength9').val());
var costqty = parseFloat($('#addqty13').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst23').val(subcost);

// Set Subtotal on RRP 24 and COST 24
var rrpcb = parseFloat($('#descrrp24').val());
var rrppp = parseFloat($('#paintrrp16').val());
var rrplen = parseFloat($('#xlength10').val());
var rrpqty = parseFloat($('#addqty14').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp24').val(subrrp);
var costcb = parseFloat($('#desccost24').val());
var costpp = parseFloat($('#paintcost16').val());
var costlen = parseFloat($('#xlength10').val());
var costqty = parseFloat($('#addqty14').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst24').val(subcost);


// Set Subtotal on RRP 25 and COST 25
var rrpcb = parseFloat($('#descrrp25').val());
var rrppp = parseFloat($('#paintrrp17').val());
var rrplen = parseFloat($('#xlength11').val());
var rrpqty = parseFloat($('#addqty15').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp25').val(subrrp);
var costcb = parseFloat($('#desccost25').val());
var costpp = parseFloat($('#paintcost17').val());
var costlen = parseFloat($('#xlength11').val());
var costqty = parseFloat($('#addqty15').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst25').val(subcost);

if ($('#invent25').val() == 'IRV37') {
	$('#xlength11').val('1');
	$('#xlength11').hide();
	}
else { 
$('#xlength11').val($('#xlength11').val());
$('#xlength11').show();
}


// Set Subtotal on RRP 26 and COST 26
var rrpcb = parseFloat($('#descrrp26').val());
var rrppp = parseFloat($('#paintrrp18').val());
var rrplen = parseFloat($('#xlength12').val());
var rrpqty = parseFloat($('#addqty16').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp26').val(subrrp);
var costcb = parseFloat($('#desccost26').val());
var costpp = parseFloat($('#paintcost18').val());
var costlen = parseFloat($('#xlength12').val());
var costqty = parseFloat($('#addqty16').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst26').val(subcost);

if ($('#invent26').val() == 'IRV37') {
	$('#xlength12').val('1');
	$('#xlength12').hide();
	}
else { 
$('#xlength12').val($('#xlength12').val());
$('#xlength12').show();
}

// Set Subtotal on RRP 27 and COST 27
var rrpcb = parseFloat($('#descrrp27').val());
var rrppp = parseFloat($('#paintrrp19').val());
var rrplen = parseFloat($('#xlength13').val());
var rrpqty = parseFloat($('#addqty17').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp27').val(subrrp);
var costcb = parseFloat($('#desccost27').val());
var costpp = parseFloat($('#paintcost19').val());
var costlen = parseFloat($('#xlength13').val());
var costqty = parseFloat($('#addqty17').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst27').val(subcost);

if ($('#invent27').val() == 'IRV37') {
	$('#xlength13').val('1');
	$('#xlength13').hide();
	}
else { 
$('#xlength13').val($('#xlength13').val());
$('#xlength13').show();
}

// Set Subtotal on RRP 28 and COST 28
var rrpcb = parseFloat($('#descrrp28').val());
var rrppp = parseFloat($('#paintrrp20').val());
var rrplen = parseFloat($('#xlength14').val());
var rrpqty = parseFloat($('#addqty18').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp28').val(subrrp);
var costcb = parseFloat($('#desccost28').val());
var costpp = parseFloat($('#paintcost20').val());
var costlen = parseFloat($('#xlength14').val());
var costqty = parseFloat($('#addqty18').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst28').val(subcost);

if ($('#invent28').val() == 'IRV37') {
	$('#xlength14').val('1');
	$('#xlength14').hide();
	}
else { 
$('#xlength14').val($('#xlength14').val());
$('#xlength14').show();
}

// Set Subtotal on RRP 29 and COST 29
var rrpcb = parseFloat($('#descrrp29').val());
var rrppp = parseFloat($('#paintrrp21').val());
var rrplen = parseFloat($('#xlength15').val());
var rrpqty = parseFloat($('#addqty19').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp29').val(subrrp);
var costcb = parseFloat($('#desccost29').val());
var costpp = parseFloat($('#paintcost21').val());
var costlen = parseFloat($('#xlength15').val());
var costqty = parseFloat($('#addqty19').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst29').val(subcost);


if ($('#invent29').val() == 'IRV37') {
	$('#xlength15').val('1');
	$('#xlength15').hide();
	}
else { 
$('#xlength15').val($('#xlength15').val());
$('#xlength15').show();
}

// Set Subtotal on RRP 30 and COST 30
var rrpcb = parseFloat($('#descrrp30').val());
var rrppp = parseFloat($('#paintrrp22').val());
var rrplen = parseFloat($('#xlength16').val());
var rrpqty = parseFloat($('#addqty20').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp30').val(subrrp);
var costcb = parseFloat($('#desccost30').val());
var costpp = parseFloat($('#paintcost22').val());
var costlen = parseFloat($('#xlength16').val());
var costqty = parseFloat($('#addqty20').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst30').val(subcost);


if ($('#invent30').val() == 'IRV37') {
	$('#xlength16').val('1');
	$('#xlength16').hide();
	}
else { 
$('#xlength16').val($('#xlength16').val());
$('#xlength16').show();
}

// Set Subtotal on RRP 31 and COST 31
var rrpcb = parseFloat($('#descrrp31').val());
var rrppp = parseFloat($('#paintrrp23').val());
var rrplen = parseFloat($('#xlength17').val());
var rrpqty = parseFloat($('#addqty21').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp31').val(subrrp);
var costcb = parseFloat($('#desccost31').val());
var costpp = parseFloat($('#paintcost23').val());
var costlen = parseFloat($('#xlength17').val());
var costqty = parseFloat($('#addqty21').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst31').val(subcost);


if ($('#invent31').val() == 'IRV37') {
	$('#xlength17').val('1');
	$('#xlength17').hide();
	}
else { 
$('#xlength17').val($('#xlength17').val());
$('#xlength17').show();
}

// Set Subtotal on RRP 32 and COST 32
var rrpcb = parseFloat($('#descrrp32').val());
var rrppp = parseFloat($('#paintrrp24').val());
var rrplen = parseFloat($('#xlength18').val());
var rrpqty = parseFloat($('#addqty22').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp32').val(subrrp);
var costcb = parseFloat($('#desccost32').val());
var costpp = parseFloat($('#paintcost24').val());
var costlen = parseFloat($('#xlength18').val());
var costqty = parseFloat($('#addqty22').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst32').val(subcost);


if ($('#invent32').val() == 'IRV37') {
	$('#xlength18').val('1');
	$('#xlength18').hide();
	}
else { 
$('#xlength18').val($('#xlength18').val());
$('#xlength18').show();
}



// Set Subtotal on RRP 33 and COST 33
var rrpcb = parseFloat($('#descrrp33').val());
var rrppp = parseFloat($('#paintrrp25').val());
var rrplen = parseFloat($('#xlength19').val());
var rrpqty = parseFloat($('#addqty23').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrppp = parseFloat(rrppp * rrplen);
var subrrp = parseFloat((subrrpcb + subrrppp) * rrpqty).toFixed(2) ;	
$('#rrp33').val(subrrp);
var costcb = parseFloat($('#desccost33').val());
var costpp = parseFloat($('#paintcost25').val());
var costlen = parseFloat($('#xlength19').val());
var costqty = parseFloat($('#addqty23').val());
var subcostcb = parseFloat(costcb * costlen);
var subcostpp = parseFloat(costpp * costlen);
var subcost = parseFloat((subcostcb + subcostpp) * costqty).toFixed(2) ;	  
$('#cst33').val(subcost);

if ($('#invent33').val() == 'IRV37') {
	$('#xlength19').val('1');
	$('#xlength19').hide();
	}
else { 
$('#xlength19').val($('#xlength19').val());
$('#xlength19').show();
}

// Set Subtotal on RRP 56 and COST 56
var rrpcb = parseFloat($('#descrrp56').val());
var rrplen = parseFloat($('#xlength26').val());
var rrpqty = parseFloat($('#addqty25').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp56').val(subrrp);
var costcb = parseFloat($('#desccost56').val());
var costlen = parseFloat($('#xlength26').val());
var costqty = parseFloat($('#addqty25').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst56').val(subcost);

if ($('#invent56').val() == 'IRV76') {
	$('#xlength26').show();
	$('#xlength26').val($('#xlength26').val());
	}
else { 
$('#xlength26').val('1');
$('#xlength26').hide();
}
	
// Set Subtotal on RRP 57 and COST 57
var rrpcb = parseFloat($('#descrrp57').val());
var rrplen = parseFloat($('#xlength27').val());
var rrpqty = parseFloat($('#addqty26').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp57').val(subrrp);
var costcb = parseFloat($('#desccost57').val());
var costlen = parseFloat($('#xlength27').val());
var costqty = parseFloat($('#addqty26').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst57').val(subcost);

if ($('#invent57').val() == 'IRV76') {
	$('#xlength27').show();
	$('#xlength27').val($('#xlength27').val());
	}
else { 
$('#xlength27').val('1');
$('#xlength27').hide();
}

// Set Subtotal on RRP 58 and COST 58
var rrpcb = parseFloat($('#descrrp58').val());
var rrplen = parseFloat($('#xlength28').val());
var rrpqty = parseFloat($('#addqty27').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp58').val(subrrp);
var costcb = parseFloat($('#desccost58').val());
var costlen = parseFloat($('#xlength28').val());
var costqty = parseFloat($('#addqty27').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst58').val(subcost);

if ($('#invent58').val() == 'IRV76') {
	$('#xlength28').show();
	$('#xlength28').val($('#xlength28').val());
	}
else { 
$('#xlength28').val('1');
$('#xlength28').hide();
}

// Set Subtotal on RRP 59 and COST 59
var rrpcb = parseFloat($('#descrrp59').val());
var rrplen = parseFloat($('#xlength29').val());
var rrpqty = parseFloat($('#addqty28').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp59').val(subrrp);
var costcb = parseFloat($('#desccost59').val());
var costlen = parseFloat($('#xlength29').val());
var costqty = parseFloat($('#addqty28').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst59').val(subcost);

if ($('#invent59').val() == 'IRV76') {
	$('#xlength29').show();
	$('#xlength29').val($('#xlength29').val());
	}
else { 
$('#xlength29').val('1');
$('#xlength29').hide();
}

// Set Subtotal on RRP 60 and COST 60
var rrpcb = parseFloat($('#descrrp60').val());
var rrplen = parseFloat($('#xlength30').val());
var rrpqty = parseFloat($('#addqty29').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp60').val(subrrp);
var costcb = parseFloat($('#desccost60').val());
var costlen = parseFloat($('#xlength30').val());
var costqty = parseFloat($('#addqty29').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst60').val(subcost);

if ($('#invent60').val() == 'IRV76') {
	$('#xlength30').show();
	$('#xlength30').val($('#xlength30').val());
	}
else { 
$('#xlength30').val('1');
$('#xlength30').hide();
}

// Set Subtotal on RRP 61 and COST 61
var rrpcb = parseFloat($('#descrrp61').val());
var rrplen = parseFloat($('#xlength31').val());
var rrpqty = parseFloat($('#addqty30').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp61').val(subrrp);
var costcb = parseFloat($('#desccost61').val());
var costlen = parseFloat($('#xlength31').val());
var costqty = parseFloat($('#addqty30').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst61').val(subcost);

if ($('#invent61').val() == 'IRV76') {
	$('#xlength31').show();
	$('#xlength31').val($('#xlength31').val());
	}
else { 
$('#xlength31').val('1');
$('#xlength31').hide();
}

// Set Subtotal on RRP 62 and COST 62
var rrpcb = parseFloat($('#descrrp62').val());
var rrplen = parseFloat($('#xlength32').val());
var rrpqty = parseFloat($('#addqty31').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp62').val(subrrp);
var costcb = parseFloat($('#desccost62').val());
var costlen = parseFloat($('#xlength32').val());
var costqty = parseFloat($('#addqty31').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst62').val(subcost);

if ($('#invent62').val() == 'IRV76') {
	$('#xlength32').show();
	$('#xlength32').val($('#xlength32').val());
	}
else { 
$('#xlength32').val('1');
$('#xlength32').hide();
}

// Set Subtotal on RRP 63 and COST 63
var rrpcb = parseFloat($('#descrrp63').val());
var rrplen = parseFloat($('#xlength33').val());
var rrpqty = parseFloat($('#addqty32').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp63').val(subrrp);
var costcb = parseFloat($('#desccost63').val());
var costlen = parseFloat($('#xlength33').val());
var costqty = parseFloat($('#addqty32').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst63').val(subcost);

if ($('#invent63').val() == 'IRV76') {
	$('#xlength33').show();
	$('#xlength33').val($('#xlength33').val());
	}
else { 
$('#xlength33').val('1');
$('#xlength33').hide();
}


// Set Subtotal on RRP 64 and COST 64
var rrpcb = parseFloat($('#descrrp64').val());
var rrplen = parseFloat($('#xlength34').val());
var rrpqty = parseFloat($('#addqty33').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp64').val(subrrp);
var costcb = parseFloat($('#desccost64').val());
var costlen = parseFloat($('#xlength34').val());
var costqty = parseFloat($('#addqty33').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst64').val(subcost);

if ($('#invent64').val() == 'IRV76') {
	$('#xlength34').show();
	$('#xlength34').val($('#xlength34').val());
	}
else { 
$('#xlength34').val('1');
$('#xlength34').hide();
}

// Set Subtotal on RRP 65 and COST 65
var rrpcb = parseFloat($('#descrrp65').val());
var rrplen = parseFloat($('#xlength35').val());
var rrpqty = parseFloat($('#addqty34').val());
var subrrpcb = parseFloat(rrpcb * rrplen);
var subrrp = parseFloat(subrrpcb  * rrpqty).toFixed(2) ;	
$('#rrp65').val(subrrp);
var costcb = parseFloat($('#desccost65').val());
var costlen = parseFloat($('#xlength35').val());
var costqty = parseFloat($('#addqty34').val());
var subcostcb = parseFloat(costcb * costlen);
var subcost = parseFloat(subcostcb * costqty).toFixed(2) ;	  
$('#cst65').val(subcost);	


if ($('#invent65').val() == 'IRV76') {
	$('#xlength35').show();
	$('#xlength35').val($('#xlength35').val());
	}
else { 
$('#xlength35').val('1');
$('#xlength35').hide();
}

// Calculate Total RRP and COST
	
var addrrp = 0;
$(".rrp").each(function() {
addrrp += Number($(this).val());
});
$("#subtotalvergolaid").val(addrrp.toFixed(2));

var addcost = 0;
$(".cst").each(function() {
addcost += Number($(this).val());
});
$("#totalcostid").val(addcost.toFixed(2));

// Add Sales Cost
$("#salescostid").val(((addrrp  / 100) * $("#salescommid").val()).toFixed(2));

// Add Installer or Erector Cost
$("#installercostid").val(((addrrp  / 100) * $("#installercommid").val()).toFixed(2));

// Add Total Sell without GST
$("#totalrrpid").val((addrrp + addrrpd).toFixed(2));

// Add Total GST
$("#totalgstid").val((((addrrp + addrrpd) / 100) * $("#gstid").val()).toFixed(2));

// Add Total Sell with GST
var totalsell = parseFloat($('#totalrrpid').val());
var totalgst = parseFloat($('#totalgstid').val());
$("#totalrrpgstid").val((totalsell + totalgst).toFixed(2));

// Add Total Cost with GST
$("#totalcostgstid").val(((addcost  / 100) * $("#gstid").val()).toFixed(2));

});


});

