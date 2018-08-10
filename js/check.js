// JavaScript Document
$(function(){
	
	var x=101,
	 r='<img src="../images/content/r.gif" height="auto" width="20px">',
	 c='<img src="../images/content/accept.png" height="auto" width="20px">';
	
	login=function(e){
		e.preventDefault();
		var pwd=$('#pwd').val(),
		usr=$('#usr').val(),
		url=$(this).closest('form').attr('action');
		$('#feedback').html('<center>'+r+'</center>');
		$.post(url,{'usr':usr,'pwd':pwd},function(data){
			if(data==x){
				window.location='index.php?q=cpanel';
			}else{
				$('div #feedback').html(data);
				}
			});
		
		}
	
	addmember=function(e){
		e.preventDefault();
		var name=$('#name').val(),
		tel=$('#tel').val(),
		pwd=$('#pwd').val(),
		sex=$('#sex').val(),
		addr=$('#addr').val(),
		dpt=$('#dpt').val(),
		role=$('#role').val(),
		url=$(this).closest('form').attr('action');
		//alert(name);
		
		$('#feedback').html('<center>'+r+' Creating Account...</center>');
		$.post(url,{'role':role,'name':name,'tel':tel,'pwd':pwd,'sex':sex,'addr':addr,'dpt':dpt},function(data){
			
				$('#feedback').html(data);		
			});
		
		}
	
	addcat=function(e){
		e.preventDefault();
		var cat=$('#cat').val(),
		url=$(this).closest('form').attr('action');
		//alert(name);
		
		$('#feedback').html('<center>'+r+'	Creating Category...</center>');
		$.post(url,{'cat':cat,'addid':1},function(data){
				if (data==x) {

					$('#feedback').html('<center>'+c+' Successfully Added A Category</center>');
				}else{

					$('#feedback').html(data);		

				}

			});	
		}

	pfile=function(event){
			event.preventDefault();
			var fdta=new FormData($('form:file')[0]);
			$.each($('#pfile')[0].files,function(i,file){
				fdta.append('file',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: '../resource/controller/fupload.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,

					beforeSend:function(event){
						
							
						$('#feedback').html('<center>'+r+' Please Wait Your File is being Uploaded...</center>');
								
						},
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==x){
							$('#feedback').empty().html('<b>'+r+'&nbsp;<span style="color:green;">File Ready</span>:Waiting For Other Fields For Submission.</b>');
							
						}else{
							$('#feedback').html(data);
							}
					}
        			});
			}
			
	getsubclass=function(event){
		
		} 	
			
	
	viewland=function(event){
		event.preventDefault();
		
		var lga=$('#lga').val(),
		url=$(this).closest('form').attr('action');
		
		
		$('table').html('<center>'+r+'	Loading...</center>');
		$.post(url,{'lga':lga,'retrieveid':1},function(data){
				if (data==x) {

					$('table').html(data);
				}else{

					$('table').html(data);		

				}

			});

		}
	
	confland=function(event){
		event.preventDefault();
		
		var pillar=$('#pillar').val(),
		url=$(this).closest('form').attr('action');
		
		
		$('table').html('<center>'+r+'	Loading...</center>');
		$.post(url,{'pillar':pillar,'retrieveid':2},function(data){
				if (data==x) {

					$('table').html(data);
				}else{

					$('table').html(data);		

				}

			});

		}

	searchusingsaleid=function(event){
		event.preventDefault();
		
		var sale=$(this).val(),
		url=$(this).closest('form').attr('action');
		
		$('#column_w300 cc').html('Loading...');
		$.post(url,{'isale':sale,'retrieveid':4},function(data){
			$('#column_w300 cc').html(data);
		});		
					
						
		$('table').html('<center>'+r+'	Loading...</center>');
		$.post(url,{'isale':sale,'retrieveid':3},function(data){
				if (data==x) {

					$('table').html(data);
								
						
				}else{

					$('table').html(data);		

				}

			});
				
		}

	csearchusingsaleid=function(event){
		event.preventDefault();
		
		var sale=$(this).val(),
		url=$(this).closest('form').attr('action');
		
						
		$('table').html('<center>'+r+'	Loading...</center>');
		$.post(url,{'csale':sale,'retrieveid':5},function(data){
				
				if (data==x) {

					$('table').html(data);
							
						
				}else{

					$('table').html(data);		

				}

			});
				
		}
		
	addtolandcart=function(event){
		//event.preventDefault();
		
			var pillar=$(this).data('pillar'),
			sale=$('#isale').val(),
			url='../resource/controller/add.php';
				$('#feedback').html('<center>'+r+'	Sending...</center>');
				
				$.post(url,{'isale':sale,'pillar':pillar,'addid':4},function(data){
					
					$('#feedback').html(' ');
					
					if (data==x) {
						var url='../resource/controller/retrieve.php';
						
						$('#column_w300 cc').html('Loading...');
						
						$.post(url,{'isale':sale,'retrieveid':4},function(data){
							$('#column_w300 cc').html(data);
							});
							
					}else{

						$('#feedback').html(data);		

					}

				});
		}
	
	deletefromlandcart=function(){

		var salecartid=$(this).data('id'),
		sale=$(this).data('sale'),
			url='../resource/controller/delete.php';
				$('#feedback').html('<center>'+r+'	Deleting From List...</center>');
				
				$.post(url,{'id':salecartid,'deleteid':1},function(data){
					
					$('#feedback').html(' ');
					
					if (data==x) {
						var url='../resource/controller/retrieve.php';
						
						$('#column_w300 cc').html('Loading...');
						
						$.post(url,{'isale':sale,'retrieveid':4},function(data){
							$('#column_w300 cc').html(data);
							});
							
					}else{

						$('#feedback').html(data);		

					}

				});
		
		}


	transferformlandcart=function(){
		
		var confsale=confirm("Do you really want to transfer, Process Can't be reversed after here?"),
		sellersaleid=$('#isale').val(),
		url='../resource/controller/add.php';	
		if(confsale==true){
		var buyersaleid=window.prompt('Enter Buyer Sale ID','Please Enter Number Only');
		$.post(url,{'sellersaleid':sellersaleid,'buyersaleid':buyersaleid,'addid':5},function(data){
					
					$('#feedback').html(' ');
					
					if (data==x) {
						$('#column_w300 cc').html('Loading...');
						
						$.post(url,{'isale':sellersaleid,'retrieveid':4},function(data){
							$('#column_w300 cc').html(data);
							});
						alert('Successful Transfer of Land Through Sale');
						window.open('index.php?q=landreceipt&buy='+buyersaleid,'','width=1000,height=700');
						
						
							
					}else{

						$('#feedback').html(data);		

					}

				});
		}else{
			return false;
			}
		
		}
	removefromshelf=function(){
		
		
		}
	
	iborrow=function(){
		bk=$(this).data('idr');
		
		
		}
	
	acceptrequest=function(){
		
		}


	declinerequest=function(){
		var id=$(this).data('drq');
		
		}

	returntolib=function(){
		
	
		}


/************************End Function*************************************/


/* **********************|Binders|****************************************** */
	
	$('#sblogin').bind('click',login);
	$('#pfile').bind('change',pfile);
	$('#lga').bind('click change',viewland);
	$('#pillar').bind('keyup',confland);
	$('#isale').bind('keyup',searchusingsaleid);
	$('#csale').bind('keyup',csearchusingsaleid);
	$('table').delegate('a#chkland','click',addtolandcart);
	$('#column_w300 cc').delegate('a#deletefromcart','click',deletefromlandcart);
	$('#column_w300 cc').delegate('a#transferfromcart','click',transferformlandcart);
	//$('#delbr').bind('click',returntolib);
	
	
	
});