         $(document).ready(function(){ /*code here*/  
		 
         for($x=0;$x<document.getElementsByTagName("table").length;$x++)
                   {  on[$x]=true;
          var table =document.getElementById("profileT"+$x);
         var row=table.insertRow(table.rows.length-1);
         added[$x]=0;
         
         row.outerHTML='<tr  valign="top"> <td bgcolor="#f5f5f5"><br></td> </tr> <tr valign="top" align="center" bgcolor="#f5f5f5"  class="shadow" ><td> <font color="#1AB92B" face="Arial" style="cursor:pointer;"  size="4" onclick="addRow('+$x+')" > + </font></tr>';//  
         	}})
			
			
			
			var added=new Array();
			var firstT=true;
			var name='';
        function addRow(tbl){
			if(firstT)
			{
				name='<font  color="#555555" face="Arial"  size="3">Add your own Question and Answer </font><br>';
				firstT=false;}else{name=''}
			var table=document.getElementById("profileT"+tbl);
         var row=table.insertRow(table.rows.length-3);
			row.outerHTML=' <tr valign="top" align="center" bgcolor="#f5f5f5" class="shadow"style="padding-top:15px;padding-bottom:15px;"><td>'+name+'<p style="padding-left:15px;padding-right:15px;padding-bottom:5px;"><input type="text" class="checkout-input checkout-name" placeholder="Your Question" value="Your Question"  onKeyUp="submitBtn('+tbl+')" title="Your Question"  id="Q'+tbl+added[tbl]+'" required x-moz-errormessage="Fill in your Email Address"  ><br><br><input type="text" onKeyUp="submitBtn('+tbl+')" value="Your Answer" class="checkout-input checkout-name" placeholder="Your Answer..."   title="Your Answer"  id="A'+tbl+added[tbl]+'" required x-moz-errormessage="Fill in your Answer"  >&nbsp;&nbsp;&nbsp;&nbsp;<select onChange="submitBtn('+tbl+')"  id="C'+tbl+added[tbl]+'" style=" border-radius: 6px; "><option value="Only me">Only me</option><option value="Only friends">Only friends</option><option value="Public">Public</option> </select> <br><br><font color="#555555" face="Arial"  size="3"> ---Or---</font><br><textarea onKeyUp="submitBtn('+tbl+')"  rows="5" class="checkout-input" style=" width:320px; height: 100%;font-size:15px;"  id="TA'+tbl+added[tbl]+'">Your Answer</textarea></p></tr>';
			added[tbl]++;
			}
			var on= new Array();
			
			
			 function submitBtn(x){
				  
		if(on[x]){//once
				 var table =document.getElementById("profileT"+x);
				 var row=table.insertRow(table.rows.length);
	 row.outerHTML='<tr   valign="top" align="right"> <td bgcolor="#f5f5f5"><font color="#999999" face="Arial" id="submitBtn" class="shadow" style=" width:100px; cursor:pointer;" size="4" onclick="postDoc('+x+')" b>  &nbsp; Save &nbsp; </font></td> </tr> ';//
				  on[x]=false;
				  }
				  
				//(\''+x+'\',\''+row+'\')  18,4
				  
			 
			 }
			 
			 
 var sticky_navigation_offset_top = $('#sticky_navigation').offset().top;
	var sticky_navigation = function(){
		
		var scroll_top = $('#target').scrollTop();
		//alert(sticky_navigation_offset_top+"H"+scroll_top)
		if (scroll_top+37 > sticky_navigation_offset_top) { 
			$('#sticky_navigation').css({ 'position': 'fixed', 'top':37 });
		} else {
			$('#sticky_navigation').css({ 'position': 'relative','top':0  }); 
		}   
	};
	
	// run our function on load   padding-left:50px;
	sticky_navigation();
	
	// and run it again every time you scroll
	$('#target').scroll(function() {
		 sticky_navigation();
	});
			
		function postDoc(tableX){
			var rowN =document.getElementById("profileT"+tableX).rows.length;
			var rowNc=(Math.ceil(rowN-2*added[tableX])/3)-2;// 2 is adjustment no
			var table='';
			var count=1;
			for(var x=0;x<rowNc;x++){table+=document.getElementById('T'+tableX+count).innerHTML+"|xy|"+document.getElementById(''+tableX+count).value+"|xy|"+document.getElementById(''+tableX+(++count)).value;
			if(x!=(rowNc-1))
			table+="|xy|";count+=2;}
			count=0
			
			if(rowNc==0)
			table+=document.getElementById(''+tableX+count).value;		
			
			for(var x=0;x<added[tableX];x++)
			{if(x==(0))
			table+="|xy|";
				table+=document.getElementById('Q'+tableX+x).value+"|xy|";
				
			if(document.getElementById('A'+tableX+x).value!=""&&(document.getElementById('A'+tableX+x).value!="Your Answer"))
			{
			table+=document.getElementById('A'+tableX+x).value+"|xy|";		
}
			else if(document.getElementById('TA'+tableX+x).value!=""&&document.getElementById('TA'+tableX+x).value!="Your Answer"){
			table+=document.getElementById('TA'+tableX+x).value+"|xy|";
			}
			else{
				$tbl=6
				if(!on[tableX])
				$tbl=4
				
				var table =document.getElementById("profileT"+tableX);
				 var row=table.insertRow(table.rows.length-$tbl);
	 row.outerHTML='<tr   valign="top" align="center" > <td><br><font color="#EC7F62" face="Arial" id="submitBtnErr" class="shadow" style=" width:250px;  cursor:pointer;" size="4" b>Please enter a correct answer in either of the boxes</font></td><br> </tr> '
	 return;} 
			table+=document.getElementById('C'+tableX+x).value
			
			if(x!=(added[tableX]-1))
			table+="|xy|"
			
			
			}
				
				$.post('validate.php',{Info:table, tableNo:tableX},
				function(data){
					alert(data);
					document.getElementById("submitBtn").innerHTML="  &nbsp; Saved &nbsp; ";
					
					}
				)
				
				
				} 
		//function test(){alert("hey")}	
			
