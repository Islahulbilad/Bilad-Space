<html>
<head>
<style rel="stylesheet" type="text/css">
*{margin:0px;padding:0px}
</style>
</head>
<body style="background:#000" >
<script type="text/javascript" src="jquery.js" /></script>
<img class="launcher" src="launch_pad.png" style="display: block;width: 246;position: fixed;top: 400;left: 392;z-index:1000" />
<img class="atmosfer" src="atmosfer.png" style="width: 100%;height: 100000;position:fixed;display: block;left: 0px;top: -99395;" />
<img class="mountain" src="mount.png" style="position: fixed;width: 842;top: 422px;left: 200;"/>
<img class="roket_s3" src="roket/a_1/payload.png" style="position: fixed;width: 26;top: 359;left: 470;"/>
<img class="roket_s2" src="roket/a_1/stage2.png" style="position: fixed;width: 26;top: 360;left: 470;z-index:1200"/>
<img class="roket_s1" src="roket/a_1/stage1_a.png" style="position: fixed;width: 33;top: 360;left: 467;z-index:1200"/>
<img class="iss" src="iss.png" style="position: fixed;width: 1000px;top: -399852px;left:-36"/>
<div style="display: block;width: 20%;color:#fff;height: 100%;position: fixed;z-index: 206;top: 0px;left: 60%;">
	<div>Scale 1px : 1 meter</div>
	<div class="btn_camera" style="padding: 5px 10px;background: #f00;width: fit-content;">Change Camera</div>
	<br>
	<h4>Stage 1</h4>
	<div style="display:flex">
		<div style="width:100px">
			<div>Altitude</div>
			<div class="alt_value" style="font-weight: bold;">0 KM</div>
		</div>
		<div  >
			<div>Distance</div>
			<div class="distance_val" style="font-weight: bold;">0 KM</div>
		</div>

	</div>
	<div style="display:flex">
		<div style="width:100px">
			<div>VSpeed</div>
			<div class="Vspeed" style="font-weight: bold;">0 KMh</div>
		</div>
		<div>
		<div>HSpeed</div>
		<div class="Hspeed" style="font-weight: bold;">0 KMh</div>
		</div>
	</div><br>
	<h4>Stage 2</h4>
	<div style="display:flex">
		<div style="width:100px">
			<div>Altitude</div>
			<div class="alt_value2" style="font-weight: bold;">0 KM</div>
		</div>
		<div  >
			<div>Distance</div>
			<div class="distance_val2" style="font-weight: bold;">0 KM</div>
		</div>

	</div>
	<div style="display:flex">
		<div style="width:100px">
			<div>VSpeed</div>
			<div class="Vspeed2" style="font-weight: bold;">0 KMh</div>
		</div>
		<div>
		<div>HSpeed</div>
		<div class="Hspeed2" style="font-weight: bold;">0 KMh</div>
		</div>
	</div><br>

</div>
<div style="display: block;width: 20%;height: 100%;position: fixed;z-index: 206;background: #fff;top: 0px;left: 80%;">
	<div style="padding:10px">
		<h3>Stage 1 Control</h3>
		<div style="margin-top: 10px;">Fuel</div>
		<progress class="fuel_val_stage1" value="100" max="100" style="width: 100%;"></progress>
		<div style="margin-top: 10px;">Throttle</div>
		<input class="gas_stage1" type="range"><br>
		<input type="hidden" value="0" class="sudut1" />
		<div style="display: flex;margin-top: 10px;cursor: pointer;">
			<div class="sudut_min" style="background: #444040;padding: 5px 10px;border-radius: 5px;color: #fff;font-weight: bold;">&lt;</div>
			<div class="sudut_plus"  style="background: #444040;padding: 5px 10px;border-radius: 5px;color: #fff;font-weight: bold;margin-left: 5px;">&gt;</div>
			<div class="btn_separate1" style="padding: 5px;background: #f00;color: #fff;border-radius: 5px;margin-left: 34px;" >Separate</div>
		</div>
		<div class="btn_launch" style="cursor:pointer;padding: 10px;color: #fff;background: #1400ff;margin-top: 10px;text-align: center;">Launch</div>
		
		<h3 style="margin-top:20px" >Stage 2 Control</h3>
		<div style="margin-top: 10px;">Fuel</div>
		<progress class="fuel_val_stage2" value="100" max="100" style="width: 100%;"></progress>
		<div style="margin-top: 10px;">Throttle</div>
		<input class="gas_stage2" type="range"><br>
		<input type="hidden" value="0" class="sudut2" />
		<div style="display: flex;margin-top: 10px;cursor: pointer;">
			<div class="sudut2_min" style="background: #444040;padding: 5px 10px;border-radius: 5px;color: #fff;font-weight: bold;">&lt;</div>
			<div class="sudut2_plus"  style="background: #444040;padding: 5px 10px;border-radius: 5px;color: #fff;font-weight: bold;margin-left: 5px;">&gt;</div>
			<div class="dock" style="padding: 5px;background: #005;color: #fff;border-radius: 5px;margin-left: 34px;" >Dock</div>
			<div class="undock" style="padding: 5px;background: #f00;color: #fff;border-radius: 5px;margin-left: 5px;" >Undock</div>
		</div>
	</div>
</div>


<script>
//Profil rocket stage 1
var propelant1 = 395000; //kg
var max_prop1= 395000;
var dry_mass1 = 25600; //kg
var F_thrust1 = 7607000; //N 
var Fuel_cost1 = 1000; // kg/s
//Profil rocket stage 1
var propelant2 = 92500; //kg
var max_prop2= 92500;
var dry_mass2 = 8900; //kg
var F_thrust2 = 934000; //N 
var Fuel_cost2 = 233; // kg/s

//RESET VALUE 
$('.sudut1').val(0);
$('.sudut2').val(0);
$('.gas_stage1').val(0);
$('.gas_stage2').val(0);
var ignition1 = false;
var ignition2 = false;
//launcer 
$('.btn_launch').click(function(){
	$('.gas_stage1').val(100);
	ignition1 = true;
});

//system kemudi
var stage1_separated = false;
var iss_docking = false;
$('.dock').click(function(){
	iss_docking = true;
	$('.gas_stage2').val(0);
});
$('.undock').click(function(){
	iss_docking = false;
});
$('.btn_separate1').click(function(){
	stage1_separated = true;
	$('.gas_stage2').val(100);
});
$('.sudut_min').click(function(){
	$('.sudut1').val(parseInt($('.sudut1').val())-5);
	if(stage1_separated==false){
		$('.sudut2').val(parseInt($('.sudut2').val())-5);
	}
});
$('.sudut_plus').click(function(){
	$('.sudut1').val(parseInt($('.sudut1').val())+5);
	if(stage1_separated==false){
		$('.sudut2').val(parseInt($('.sudut2').val())+5);
	}
});

$('.sudut2_min').click(function(){
	$('.sudut2').val(parseInt($('.sudut2').val())-5);
});
$('.sudut2_plus').click(function(){
	$('.sudut2').val(parseInt($('.sudut2').val())+5);
});

//kamera 
var cam_state = 1;
$('.btn_camera').click(function(){
	if(cam_state==0){cam_state=1}else{cam_state=0}
});
function kamera(){
	if(cam_state==1){
		$('.roket_s1').css("display","block");
		$('.launcher').css("top",371+alt_s1);
		$('.launcher').css("left",392-dis_s1);
		$('.atmosfer').css("top",-99395+alt_s1);
		$('.mountain').css("top",442+(alt_s1/25));
		$('.mountain').css("left",200-(dis_s1/25));
		if(stage1_separated==true){
			$('.roket_s2').css("display","none");
			$('.roket_s3').css("display","none");
		}
	}else{
		$('.launcher').css("top",371+alt_s2);
		$('.launcher').css("left",392-dis_s2);
		$('.atmosfer').css("top",-99395+alt_s2);
		$('.mountain').css("top",442+(alt_s2/25));
		$('.mountain').css("left",200-(dis_s2/25));
		if(stage1_separated==true){
			$('.roket_s1').css("display","none");
			$('.roket_s2').css("display","block");
			$('.roket_s3').css("display","block");
		}
	}
}
//VARIABEL FISIKA 
var alt_s1 = 29;
var alt_s2 = 160;
var alt_s3 = 266;
var dis_s1 = 0;
var dis_s2 = 0;
var dis_s3 = 0;
//speed
var Vv_s1 = 0;
var Vv_s2 = 0;
var Vv_s3 = 0;
var Vh_s1 = 0;
var Vh_s2 = 0;
var Vh_s3 = 0;
//sentrifugal 
var Fs_s1 = 0;
var Fs_s2 = 0;
var Fs_s3 = 0;
//gaya resultan 
var Frh_s1 = 0;
var Frh_s2 = 0;
var Frh_s3 = 0;
var Frv_s1 = 0;
var Frv_s2 = 0;
var Frv_s3 = 0;

	
//realtime 
setInterval(function(){
	//stage1 dan 2 gabung
	if(stage1_separated==false){
		if(alt_s1<0||propelant1<1){ignition1=false;}
		if(ignition1==true){
			//fisika gerak
			Frv_s1 = (Math.cos(parseInt($('.sudut1').val())*Math.PI/180)*F_thrust1*$('.gas_stage1').val()/100)+Fs_s1- ((propelant1+dry_mass1+propelant2+dry_mass2)*(9.85-(alt_s1*0,000003)));
			Vv_s1 = Vv_s1+(Frv_s1/(propelant1+dry_mass1+propelant2+dry_mass2)/100); //0.02 m/10 ms
			alt_s1 = alt_s1 + (Vv_s1/100);
			$('.Vspeed').html(Math.floor(Vv_s1*3.6)+" KMh");
			$('.Vspeed2').html(Math.floor(Vv_s1*3.6)+" KMh");
			
			//horizontal
			Frh_s1 = (Math.sin(parseInt($('.sudut1').val())*Math.PI/180)*F_thrust1*$('.gas_stage1').val()/100)-(Math.cos(parseInt($('.sudut1').val())*Math.PI/180));
			Vh_s1 = Vh_s1+(Frh_s1/(propelant1+dry_mass1+propelant2+dry_mass2)/100); //0.02 m/10 ms
			dis_s1 = dis_s1 + (Vh_s1/100);
			$('.Hspeed').html(Math.floor(Vh_s1*3.6)+" KMh");
			$('.Hspeed2').html(Math.floor(Vh_s1*3.6)+" KMh");
			
			//sentrifugal 
			Fs_s1 = (propelant1+dry_mass1)*Vh_s1*Vh_s1/(6371+alt_s1);
			propelant1 = propelant1 - (Fuel_cost1*$('.gas_stage1').val()/10000);
			
			//pengaruh gaya gerak ke stage 2 
			Frv_s2 = Frv_s1;
			Frh_s2 = Frh_s1;
			Vv_s2 = Vv_s1;
			Vh_s2 = Vh_s1;
			alt_s2 = alt_s1+131;
		}
		if(alt_s1>999){
			$('.alt_value').html((alt_s1/1000).toFixed(2)+" Km");
			$('.alt_value2').html((alt_s2/1000).toFixed(2)+" Km");
		}else{
			$('.alt_value').html(alt_s1.toFixed(2)+" meter");
			$('.alt_value2').html(alt_s2.toFixed(2)+" meter");
		}
		$('.distance_val').html((dis_s1/1000).toFixed(2)+" Km");
		$('.distance_val2').html((dis_s1/1000).toFixed(2)+" Km");
		$('.fuel_val_stage1').val(propelant1/max_prop1*100);
		
	}
	//stage1 dan 2 terpisah
	else{
		//FISIKA PADA STAGE 2
		//vertical 
		Frv_s2 = (Math.cos(parseInt($('.sudut2').val())*Math.PI/180)*F_thrust2*$('.gas_stage2').val()/100)+Fs_s2- ((propelant2+dry_mass2)*(9.85-(alt_s2*0,000003)));
		Vv_s2 = Vv_s2+(Frv_s2/(propelant2+dry_mass2)/100); //0.02 m/10 ms
		alt_s2 = alt_s2 + (Vv_s2/100);
		$('.Vspeed').html(Math.floor(Vv_s1*3.6)+" KMh");
		$('.Vspeed2').html(Math.floor(Vv_s2*3.6)+" KMh");
		
		//horizontal
		Frh_s2 = (Math.sin(parseInt($('.sudut2').val())*Math.PI/180)*F_thrust2*$('.gas_stage2').val()/100)-(Math.cos(parseInt($('.sudut1').val())*Math.PI/180));
		Vh_s2 = Vh_s2+(Frh_s2/(propelant2+dry_mass2)/100); //0.02 m/10 ms
		dis_s2 = dis_s2 + (Vh_s2/100);
		$('.Hspeed').html(Math.floor(Vh_s1*3.6)+" KMh");
		$('.Hspeed2').html(Math.floor(Vh_s2*3.6)+" KMh");

		//sentrifugal 
		Fs_s2 = (propelant2+dry_mass2)*Vh_s2*Vh_s2/(6371+alt_s2);
		propelant2 = propelant2 - (Fuel_cost2*$('.gas_stage2').val()/10000);

		if(alt_s2>999){
			$('.alt_value').html((alt_s1/1000).toFixed(2)+" Km");
			$('.alt_value2').html((alt_s2/1000).toFixed(2)+" Km");
		}else{
			$('.alt_value').html(alt_s1.toFixed(2)+" meter");
			$('.alt_value2').html(alt_s2.toFixed(2)+" meter");
		}
		$('.fuel_val_stage2').val(propelant2/max_prop2*100);
		$('.distance_val2').html((dis_s2/1000).toFixed(2)+" Km");
		$('.distance_val').html((dis_s1/1000).toFixed(2)+" Km");
		
		//FISIKA PADA STAGE 1
		if(alt_s1>28){
			Frv_s1 = (Math.cos(parseInt($('.sudut1').val())*Math.PI/180)*F_thrust1*$('.gas_stage1').val()/100)+Fs_s1- ((propelant1+dry_mass1+propelant2+dry_mass2)*(9.85-(alt_s1*0,000003)));
			Vv_s1 = Vv_s1+(Frv_s1/(propelant1+dry_mass1+propelant2+dry_mass2)/100); //0.02 m/10 ms
			alt_s1 = alt_s1 + (Vv_s1/100);
			$('.Vspeed').html(Math.floor(Vv_s1*3.6)+" KMh");
			
			
			//horizontal
			Frh_s1 = (Math.sin(parseInt($('.sudut1').val())*Math.PI/180)*F_thrust1*$('.gas_stage1').val()/100)-(Math.cos(parseInt($('.sudut1').val())*Math.PI/180));
			Vh_s1 = Vh_s1+(Frh_s1/(propelant1+dry_mass1+propelant2+dry_mass2)/100); //0.02 m/10 ms
			dis_s1 = dis_s1 + (Vh_s1/100);
			$('.Hspeed').html(Math.floor(Vh_s1*3.6)+" KMh");

		}
		
		//sentrifugal 
		Fs_s1 = (propelant1+dry_mass1)*Vh_s1*Vh_s1/(6371+alt_s1);
		propelant1 = propelant1 - (Fuel_cost1*$('.gas_stage1').val()/10000);
	}
	
	//statistik 
	$('.roket_s1').css('rotate',$('.sudut1').val()+"deg");
	$('.roket_s2').css('rotate',$('.sudut2').val()+"deg");
	$('.roket_s3').css('rotate',$('.sudut2').val()+"deg");
	//UI
	kamera();
	$(".iss").css("top",-399852+alt_s2);
	if(iss_docking==true){
		Frv_s2 = 0;
		Vv_s2 = 0;
	}
	
	if(dis_s2>40009880){
		dis_s2 = 0;
	}
},10);

</script>
</body>
</html>