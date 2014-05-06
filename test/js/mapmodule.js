$(document).ready(function() {
var currentLat,currentLong,srcc,destt,destLat,destLong;
var markers= [];
var autolist;
 //$("span.jcalendar").jcalendar();
function displayBooking()
{
document.getElementById('lighte').style.display='block';
document.getElementById('fadee').style.display='block';
} 
 $("#UserLogin").click(function(){
 			                            	  
 		                            	 var uname=$("#LoginUserName").val(); 
 			                            	 var pwd=$("#LoginUserPwd").val(); 
 			                            	 var cmt=$("#user_comment").val(); 
 			                            	 var rate=$("#user_rate").val(); 
 			                            	 var auto_id=$("#active_auto_id").val(); 
 			                            	 if(uname != "" && pwd != ""){ 
 			                            	 
 			                            		 $.ajax({ 
 			       								   
 			       				url: "http://autohonatest.meximas.com/service/loginstatus.php?uname="+uname+"&pwd="+pwd+"&cmt="+cmt+"&rate="+rate+"&autoId="+auto_id, 
 			       								  dataType:"json", 
 			       								  success:function(data){ 
 			       								   if(data.status=="success"){ 
 			       									   alert("success"); 
 			       								   }else{ 
 			       									   alert("failed"); 
 			       								   } 
 			       																   
 			       								  }, 
 			       								  error:function(){ 
 			       									 
 			       								  } 
 			       						}); 
 			                            		  
 			                            	 } 
 			                            	  
 			                             }); 

					$("#regUser").click(function() {
						var fname=$("#regFirstName").val();
						var lname=$("#regLastName").val();
						var email=$("#regEmail").val();
						var pwd=$("#regPwd").val();
						var phone=$("#regMobile").val();
						function validateEmail()
						{
						   var emailID = email;
						   atpos = emailID.indexOf("@");
						   dotpos = emailID.lastIndexOf(".");
						   if (atpos < 1 || ( dotpos - atpos < 2 )) 
						   {
						       alert("Please enter correct email ID")
						       document.myForm.EMail.focus() ;
						       return false;
						   }
						   return( true );
						}
						function PhoneNumber()
						{
						  var PhoneID = phone;
						  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
						  if(PhoneID.match(phoneno))
						        {
								
						      return true;
						        }
						      else
						        {
						        alert("Not a valid Phone Number");
						        return false;
						        }
						}


						if(fname.length<20&&fname.length!=""&&fname.length>4)
						{
						if(lname.length<20&&lname.length!=""&&lname.length>4)
						{
						  var ret = validateEmail();
						  if( ret == true )
						  {
						     if(pwd.length<20&&pwd.length!=""&&pwd.length>8)
							 {

							 var rec = PhoneNumber();
							 	 
							 if(rec==true)
							 {
							       $.ajax({
								  
								  url: "http://autohonatest.meximas.com/service/getAutoData.php?type=register&firstName="+fname+"&lastName="+lname+"&pwd="+pwd+"&phone="+phone+"&email="+email,
								  dataType:"json",
								  success:function(){
									//  alert("saved successfully");
						saveUserReview();
						           $("#lean_overlay").fadeOut(200);
						          //var modal_id = $(this).attr("href");

						                $(".popupContainer").fadeOut(200);
																  
								  },
								  error:function(){
									 // alert("data input error");
								  }
						});
							 }
							 }
							 else
							 {
							 alert("password must be 8 - 12 characters!!");
							 }
						  }
						}
						else{
						alert("enter correct Second name should not exceed 20 characters")
						}
						}
						else{
						alert("enter correct First name should not exceed 20 characters")
						}



									});

					function setRoute() {
						if (sourcestore != '' && destinationstore != '') {

							calcRoute();
						} else {
							//$("#message").text("please enter the google adress bars.... source and destination").fadeIn(1000).fadeOut(3000);
document.getElementById("pac-input1").className = document.getElementById("pac-input1").className + " error";
					document.getElementById("pac-input2").className = document.getElementById("pac-input2").className + " error";
alertify.alert("Please ensure you must select the city from suggestion list.! Thank you")
							$("#pac-input1").focus();

						}
					}
					function calcRoute() {

						var start = sourcestore;
						var end = destinationstore;

						var request = {
							origin : start,
							destination : end,
							travelMode : google.maps.TravelMode.DRIVING
						};
						directionsService.route(request, function(response,
								status) {
							if (status == google.maps.DirectionsStatus.OK) {
								directionsDisplay.setDirections(response);
								 codeAddress();
								//getAutoData();
							}
						});
						
					}
					function codeAddress() {
                        if(geocoder==null)
						    geocoder = new google.maps.Geocoder();
						var src_address = document.getElementById("pac-input1").value;
						var dest_address = document.getElementById("pac-input2").value;
						geocoder.geocode({ 'address': dest_address},
									 function(results, status) {
								
										if (status == google.maps.GeocoderStatus.OK) 
										{
							                destLat=results[0].geometry.location.lat();
											destLong=results[0].geometry.location.lng();
										}
											else 
											{
												 	$("#message").html("Geocode was not successful for the following reason: " + status).trigger("pagecreate").fadeIn(2000).fadeOut();
											}
									});
						geocoder.geocode({ 'address': src_address},
									 function(results, status) {
								
							                if (status == google.maps.GeocoderStatus.OK) {
							                currentLat=results[0].geometry.location.lat();
											currentLong=results[0].geometry.location.lng();
												srcc  = "" + $("#pac-input1").val();
												destt = "" + $("#pac-input2").val();
												getAutoData();
											        
								               }
											 else {
												 	
												 	$("#message").html("Geocode was not successful for the following reason: " + status).trigger("pagecreate").fadeIn();
											 		}
									});
									
									
					}//codeAddress()
					function getAutoData() {
					rightopen();
						
					$(".black_overlay").fadeIn(200);
						alertify.log("Loading....")
						 
						 var urll = "http://autohonatest.meximas.com/service/getAutoData.php?type=autolist&currentLat="+currentLat+"&currentLng="+currentLong+"&source="+srcc+"&destination="+destt+"&destLat="+destLat+"&destLng="+destLong;
						 $.ajax({
									url : urll,
									cache : false,
									dataType : "json",
									success : function(dataAll) {
										$(".black_overlay").fadeOut(200);
										$("#message").text("Loading...").fadeOut(2000);
										$("#autolistDiv").html("");
										var data = dataAll[0].data;
										console.log(dataAll);
										var faree = dataAll[1].fare;
										autolist =data;
										window.location.autolist = data;
										data.sort(function(a, b) {
											return parseFloat(a.dist)
													- parseFloat(b.dist)
										});

										$.each(data,function(index, value) {

															$("#autolistDiv")
																	.append(
																			"<a><div class='auto' id='"+value.autoid+"'>Id:"
																					+ value.autoid
																					+ "<br>Name:"
																					+ value.drivername
																					+ "<br>Dist:"
																					+ value.dist/1000 +"KM"
																					+ "<br>Fare:"
																					+ faree
																					+ "<div class='display-item'></div><button id='"
																					+ value.autoid
																					+ "' index='"
																					+ index
																					+ "' onclick=\"popupDiv('"+value.autoid+"');\" class='orange' >Details</button></div></a>");
														});
										pointingAutos();
									},
									error : function(error) {
										$(".black_overlay").fadeOut(200);
										$("#message").text("Error in getting data......").fadeIn().fadeOut(3000);
							
									
									}
								});

					}

					var pointingAutos = function() {

						var autolis = autolist;

						var marker;
						markers = new Array();
						
						// Add the markers and infowindows to the map
						for (var i = 0; i < autolis.length; i++) {
						//alert("placing");
							marker = new google.maps.Marker({
								position : new google.maps.LatLng(
										autolis[i].latitude,
										autolis[i].longitude),
								icon : 'img/auto.png',
								map : map
							});

							markers.push(marker);
							google.maps.event
									.addListener(
											marker,
											'click',
											(function(marker, i) {
												return function() {
													infowindow
															.setContent("Auto<br>DriverName:"
																	+ autolis[i].drivername
																	+ "<br>Rating"
																	+ autolis[i].rating
																	+ "<br>Distance"
																	+ autolis[i].dist
																	+ "mtr<br/><span onclick=\"popupDiv('"+autolis[i].autoid+"');\" sytle='cursor: pointer;'><b>More....</b></span>");													infowindow
															.open(map, marker);
												}
											})(marker, i));

						}
					}
					var infowindow = new google.maps.InfoWindow({
                                           
					 //maxWidth: 200
					});
					$("#roundtrip").click(function() {
					closeright();
					if(document.getElementById("pac-input1").value&&document.getElementById("pac-input2").value!='')
					{
                                        document.getElementById("pac-input1").className = document.getElementById("pac-input1").className + " nerror";
					document.getElementById("pac-input2").className = document.getElementById("pac-input2").className + " nerror";
                                        displayBooking();
					document.getElementById('srcre').innerHTML= document.getElementById("pac-input1").value;
					document.getElementById('dscre').innerHTML= document.getElementById("pac-input2").value;			
					}else
					{
                                        document.getElementById("pac-input1").className = document.getElementById("pac-input1").className + " error";
					document.getElementById("pac-input2").className = document.getElementById("pac-input2").className + " error";
					//alert("enter the source and destination!");
alertify.error("You must enter the source and destination values");
$("#pac-input1").focus();
					}
					});
					
					$("#showRighte").click(function() {

					if(document.getElementById("pac-input1").value!=''&&document.getElementById("pac-input2").value!='')
					{
					//alert(markers.length+"goiing to loop");
					document.getElementById('srcre').innerHTML= document.getElementById("pac-input1").value;
					document.getElementById('dscre').innerHTML= document.getElementById("pac-input2").value;
					}					

																if(markers.length!=0)
																{
																 
																for (var i = 0; i < markers.length; i++) {
																//alert()
																markers[i].setMap(null);
																}
																markers = [];
																}
			
					//alert(markers.length);
			
										var src = document.getElementById("pac-input1").value;
										var dst = document.getElementById("pac-input2").value;

										// console.log(document.getElementById("pac-input1").value);
										if (src == ""|| src.localeCompare("enter source") == 0) {
											document.getElementById("pac-input1").className = document.getElementById("pac-input1").className + " error";
alertify.error("You must enter the source !");
											$("#pac-input1").focus();
											return;

										}

										if (dst == "" || dst.localeCompare("enter destination") == 0) {
											document.getElementById("pac-input1").className = document.getElementById("pac-input1").className + " nerror";
											document.getElementById("pac-input2").className = document.getElementById("pac-input2").className + " error";
alertify.error("You must enter the destination !");
											$("#pac-input2").focus();

											return;
										}
										if (src != "" && dst != "") {
											document.getElementById("pac-input1").className = document.getElementById("pac-input1").className + " nerror";
											document.getElementById("pac-input2").className = document.getElementById("pac-input2").className + " nerror";
alertify.success("Please wait Autohona Thinking!");
											setRoute();
										}
										// codeAddress();
										// getAutoData();

									});

					var town1, town2, sourcestore = '', destinationstore = '';
					var directionsDisplay;
					var directionsService;
					var map;
					var geocoder;
					function initialize() {
						headerDown();
						bottomUp();
						//rightopen();
						geocoder = new google.maps.Geocoder();
						directionsService = new google.maps.DirectionsService();

						var mapOptions = {
							center : new google.maps.LatLng(17.385044,
									78.486671),
							zoom : 13,
							disableDefaultUI : true
						};
						directionsDisplay = new google.maps.DirectionsRenderer();
						map = new google.maps.Map(document
								.getElementById('map-canvas'), mapOptions);
						directionsDisplay.setMap(map);

						var input = (document.getElementById('pac-input1'));
						var options = {
  componentRestrictions: {country: 'ind'}
};
var options1 = {
  componentRestrictions: {country: 'ind'}
};
						var button_search = (document
								.getElementById('find_location'));

						var types = document.getElementById('type-selector');

						var autocomplete = new google.maps.places.Autocomplete(
								input, options);
						autocomplete.bindTo('bounds', map);

						google.maps.event
								.addListener(
										autocomplete,
										'place_changed',
										function() {
											var place = autocomplete.getPlace();

											var address = '';
											if (place.address_components) {
												address = [
														(place.address_components[0]
																&& place.address_components[0].short_name || ''),
														(place.address_components[1]
																&& place.address_components[1].short_name || ''),
														(place.address_components[2]
																&& place.address_components[2].short_name || '') ]
														.join(',');
											}
											sourcestore = address;
										});

						var input1 = (document.getElementById('pac-input2'));

						var types1 = document.getElementById('type-selector');

						var autocomplete1 = new google.maps.places.Autocomplete(
								input1, options1);
						autocomplete.bindTo('bounds', map);
						google.maps.event
								.addListener(
										autocomplete1,
										'place_changed',
										function() {
											var place1 = autocomplete1
													.getPlace();
											var address1 = '';
											if (place1.address_components) {
												address1 = [
														(place1.address_components[0]
																&& place1.address_components[0].short_name || ''),
														(place1.address_components[1]
																&& place1.address_components[1].short_name || ''),
														(place1.address_components[2]
																&& place1.address_components[2].short_name || '') ]
														.join(',');
											}
											destinationstore = address1;
										});

						// --------------map loaded end -----------//
						// --------search and pointing ----------//

						

					}
					google.maps.event.addDomListener(window, 'load',initialize);
$("#bookbut").click(function() 
{
var dateandtime = $("#dateandtim").val();
var d = (new Date(dateandtime)).getTime();
var yy = $('#year').val();
var mm = $('#month').val();
var dd = $('#day').val();
var dateis = yy+"-"+mm+"-"+dd;
var hh = $('#hour :selected').text();
var mn = $('#minute :selected').text();
var timeis = hh+":"+mn;
//alert(dateis+"  -  "+timeis);
var srcloc, destloc, roundtrip;
srcloc = $("#srcre").text();
destloc = $("#dscre").text();
var tripflag=$('#isrtrip').is(':checked') ? "Y" : "N";
var urll = "http://autohonatest.meximas.com/service/setAppointement.php?type=bookingAuto&userId=49&fromLoc="+srcloc+"&toLoc="+destloc+"&timeS="+timeis+"&tripFlag="+tripflag+"&dateS="+dateis+"&timeE=02:32:02&dateE=2014-04-30";
console.log(urll);
						 $.ajax({
									url : urll,
									cache : false,
									dataType : "json",
									success : function(dataAll) {
									alertify.alert(dataAll.message+"\n please check your mail for preceedings.");
									},
									error : function(error) {
									alertify.alert("server busy please try again some time!");
									}
								});
});
});	