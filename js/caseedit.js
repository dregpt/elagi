// JavaScript Document

$(document).ready(function(){

//Functions
	
// Update form item values when user choose a certain case name:
	
  $( function() {
    $( ".sessions" ).accordion();
  } );

if(location.search != ""){
	//check POST first via ajax!
		$("input[name*='frst_nm']" ).val($('#frst_nm').val());
		$("input[name*='scnd_nm']" ).val($('#scnd_nm').val());
		$("input[name*='thrd_nm']" ).val($('#thrd_nm').val());
		$("input[name*='lst_nm']" ).val($('#lst_nm').val());
		$("input[name*='fthr_wrk']" ).val($('#fthr_wrk').val());
		$("input[name*='mthr_wrk']" ).val($('#mthr_wrk').val());
		$("input[name*='mthr_nm']" ).val($('#mthr_nm').val());
		$("input[name*='address']" ).val($('#address').val());
		$("input[name*='dob']" ).val($('#dob').val());
		$("input[name*='eml']" ).val($('#eml').val());
		$("input[name*='ph1']" ).val($('#ph1').val());
		$("input[name*='ph2']" ).val($('#ph2').val());
		$("input[name*='file_id']" ).val($('#file_id').val());
		$("input[name*='referral']" ).val($('#referral').val());
		$("input[name*='dof']" ).val($('#dof').val());
		$("#usr_categ option[value='"+$('#usr_catg').val()+"'").attr('selected','selected');	

}else{
	$('#caseeditform').find('*').prop("disabled", true);
	
}
	
	
	
	// Tohover column 2 in tables:
	$('table tr > td:nth-child(2), table tr > th:nth-child(2)').find('*').mouseover(function(){
		$('table tr > td:nth-child(2), table tr > th:nth-child(2)').attr('style', 'background-color:#313131;');
	})
	$('table tr > td:nth-child(2), table tr > th:nth-child(2)').find('*').mouseout(function(){
		$('table tr > td:nth-child(2), table tr > th:nth-child(2)').attr('style', 'background-color:#1F1F1F;');
	})
	
	// Tohover column 3 in tables:
	$('table tr > td:nth-child(3), table tr > th:nth-child(3)').find('*').mouseover(function(){
		$('table tr > td:nth-child(3), table tr > th:nth-child(3)').attr('style', 'background-color:#313131;');
	})
	$('table tr > td:nth-child(3), table tr > th:nth-child(3)').find('*').mouseout(function(){
		$('table tr > td:nth-child(3), table tr > th:nth-child(3)').attr('style', 'background-color:#1F1F1F;');
	})	
	
	// Tohover column 4 in tables:
	$('table tr > td:nth-child(4), table tr > th:nth-child(4)').find('*').mouseover(function(){
		$('table tr > td:nth-child(4), table tr > th:nth-child(4)').attr('style', 'background-color:#313131;');
	})
	$('table tr > td:nth-child(4), table tr > th:nth-child(4)').find('*').mouseout(function(){
		$('table tr > td:nth-child(4), table tr > th:nth-child(4)').attr('style', 'background-color:#1F1F1F;');
	})	

		// Tohover column 5 in tables:
	$('table tr > td:nth-child(5), table tr > th:nth-child(5)').find('*').mouseover(function(){
		$('table tr > td:nth-child(5), table tr > th:nth-child(5)').attr('style', 'background-color:#313131;');
	})
	$('table tr > td:nth-child(5), table tr > th:nth-child(5)').find('*').mouseout(function(){
		$('table tr > td:nth-child(5), table tr > th:nth-child(5)').attr('style', 'background-color:#1F1F1F;');
	})	
	
		// Tohover column 6 in tables:
	$('table tr > td:nth-child(6), table tr > th:nth-child(6)').find('*').mouseover(function(){
		$('table tr > td:nth-child(6), table tr > th:nth-child(6)').attr('style', 'background-color:#313131;');
	})
	$('table tr > td:nth-child(6), table tr > th:nth-child(6)').find('*').mouseout(function(){
		$('table tr > td:nth-child(6), table tr > th:nth-child(6)').attr('style', 'background-color:#1F1F1F;');
	})	
	
		// Tohover column 7 in tables:
	$('table tr > td:nth-child(7), table tr > th:nth-child(7)').find('*').mouseover(function(){
		$('table tr > td:nth-child(7), table tr > th:nth-child(7)').attr('style', 'background-color:#313131;');
	})
	$('table tr > td:nth-child(7), table tr > th:nth-child(7)').find('*').mouseout(function(){
		$('table tr > td:nth-child(7), table tr > th:nth-child(7)').attr('style', 'background-color:#1F1F1F;');
	})
	
		// Tohover column 8 in tables:
	$('table tr > td:nth-child(8), table tr > th:nth-child(8)').find('*').mouseover(function(){
		$('table tr > td:nth-child(8), table tr > th:nth-child(8)').attr('style', 'background-color:#313131;');
	})
	$('table tr > td:nth-child(8), table tr > th:nth-child(8)').find('*').mouseout(function(){
		$('table tr > td:nth-child(8), table tr > th:nth-child(8)').attr('style', 'background-color:#1F1F1F;');
	})

	
	

	

	

	

	


	
	
	
	
});
	
	
	
	
