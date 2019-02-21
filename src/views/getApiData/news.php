
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Coefficient 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20131117

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DODS</title>	

<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />



<style>	
	iframe { overflow: hidden; }
	.sectionActSlide{ 
		display:flex;  
		width:100%; 
		height:400px; 
		margin-top:50px;
		position:relative;
	}
	.sectionImage{
		position:absolute;
		width:100%;
		height:100%;
		background-color:#fff;
		background-size:cover; 
		opacity: 0.3;
		background-color:rgba( 255,255,255,0.2);
		background-image:url("../../../images/travel.jpg")
	}
</style>
	<div style="display:inline-block; position:absolute; right:0px;top:15px;"> 
		<div style='display:flex; justify-content: center; text-align:center;'>
			<!-- <button class='btn-size' style='color: #000; width:50px; height:50px; ' onClick='fontSize_minus()'>  -a </button>|
			<button class='btn-size' style='color: #000; width:50px; height:50px; ' onClick='fontSize_normal()'> aA </button>|  
			<button class='btn-size' style='color: #000; width:50px; height:50px; ' onClick='fontSize_plus()'>   a+ </button> 
			<button class='btn-size convertTxt' style='color: #000' onClick='convertTxt()'>TH</div>  -->
		</div>
	</div>
</head>
<body>
<div id='app-3'  style='height:100%;background-color:#fff'>	
<div id="wrapper" >
	<!-- <div id="myModal" class="modal" style='overflow: hidden;'> 
		<div class="modal-content" style='margin-top:50px; padding:0px; height:70vh; margin-top:15vh; overflow:hidden; position:relative;'> 
			<span style='height:50px; width:100%; position:absolute; top:0px; left:0px;' class="close" onclick="closeModal()">&times; close</span>
			<iframe style="border:0px; width:100%; height:100%; overflow:hidden"
			src="../../../slide.php"></iframe> 
		</div> 
	</div>
 --> 
	<div style='display:flex; align-items: center ; margin-top:0px; background-color:#fff;'>	
		<div class='margin-left:20px; height:100%;'>
			<div class='row kanit' style='font-size:40px; border-bottom:5px solid #5BB9FA ; margin-bottom:30px; '>
				<div id='cat-header'style='color:#5BB9FA;' class='col-xs-12'>
					ข่าวประชาสัมพันธ์ 
					<span style='font-size:15px; right:0px; color:#777;'  class='hoverAble' onClick="goPage('page-economy.php')">
						อ่านทั้งหมด
					</span>
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-2'>
					<div class='categories-panel'>
						<div class='category active' cat='procure_' onClick='setState(this)'>
							<img class='hoverAble tab-bullet '  onClick="addActive(this)" src="../../../images/infoicon.png">
							<div class='txt'> จัดซื้อ / จัดจ้าง</div>
						</div>

						<div class='category'  cat='order_' onClick='setState(this)'>
							<img class='hoverAble tab-bullet'  onClick="addActive(this)" src="../../../images/applyicon.png">
							<div class='txt'>หนังสือสั่งการ</div>
						</div> 

						<div class='category'  cat='recruit_' onClick='setState(this)'>
							<img class='hoverAble tab-bullet'  onClick="addActive(this)" src="../../../images/applyicon.png">
							<div class='txt'>ข่าวรับสมัครงาน</div>
						</div>  
					</div>
				</div>

				<div class='col-xs-10'>
					<div class='row'>
						<span>การจัดซื้อจัดจ้าง</span>
						<span>ร่าง Tor</span>
						<span>ประกวดราคา</span> 
						<span>ประกาศสอบราคา</span> 
					</div>

					<div class='row'>		
						<table 
							id='table-info' 
							class="table" 
							cellspacing="0"
							style='font-size:16px;'
						>
							<thead>
								<th style='width:80%'>รายการ</th> 
								<th>วันที่</th> 
							</thead>
						</table>  
					</div>
				</div>
			</div>
		</div>
	</div> 
	</div>  
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.6/dist/vue.js"></script>

<script>
	$(document).ready(function(){ 
	}); 
	
	function parseRSS(inputUrl, callback) { 
		$.ajax({
			url: "./feed.php" ,
			type: 'POST',
			data : { url :inputUrl }, 
			success: function(data) { 
				callback(data);	
			}
		});
	}


	var news_state = "procure_" ;
	var sub_state  = "1" ;
	var tmp_data  = [{}] ;
	var data_sale = [  
		{ "type": "center_" , "subType": "5" , "name": "เลขที่ 88/2562 ประมูลขายทอดตลาดครุภัณฑ์ยานพาหนะและขนส่ง จำนวน 3 คัน" , "date" : "17 มกราคม 2562" }  ,
		{ "type": "recruit_" , "subType": "1" , "name": "เรื่อง รับสมัครข้าราชการพลเรือน เพื่อแต่งตั้งให้ดำรงตำแหน่งประเภทบริหารระดับต้น"  , "date" : "25 มกราคม 2562" }  ,
		{ "type": "order_"   , "subType": "1"   , "name": "คำสั่งที่ 817/2561 เรื่อง แต่งตั้งคณะกรรมการการ"  , "date" : "25 มกราคม 2562" }  ,
	];
 
	function setState( input ){
		let cat = $(input).attr("cat"); 
			news_state = cat ; 
			genNewTable();  
	}

	function search(){
		let inp = $('#srcTxt').val(); 
	}
   
	let url = "https://www.dit.go.th/rss_news_procurement1.aspx";  
	parseRSS(url,function(x){
		let data = JSON.parse(x);
		// console.log(data); 
		let procure = data.channel.item;
		let newObj = procure.map(function( x ,idx ){  
			let basemark = {
				subType : "1" , 
				type : "rss_" , 
				name : "(RSS included) ****** " + x.title , 
				link : x.link, 
				date : "20 มกราคม 2563"
			} ;
			data_sale.push(basemark);
			return basemark;
		}); 
		// data_sale = Object.assign(data_sale, newObj);  
		genNewTable();  
	});
 

	function genNewTable(){ 
		
		let a = data_sale.filter(function(x){
			return x.type == news_state ;
		}); 
		// console.log(" ------------ " ,news_state);

		let b = a; 
		if(news_state == "center_"){
			let b = a.filter(function(x){
				return x == sub_state ;
			});
		}  
		tmp_data = b ;

		$('#table-info').DataTable({
			"dom": '<"toolbar">ftip',
			destroy: true ,
			data: tmp_data ,
			"pageLength": 5 ,
			columns : [ 
				{data: 'name'} ,
				{data: 'date'} ,
			]
		});

			
		$('#table-info').on('click', 'tr', function () {
			var data = table.row( this ).data();
			alert( 'You clicked on '+data[0]+'\'s row' );
		} );
	} 

	function addActive( obj ){
		$('.category').removeClass("active");
		$(obj).parent('.category').addClass('active');
	} 

	function genLink(name , catm , prog , param  ){
		let a = "<a target='_blank' href='./page-detail.php?catm=" + catm +"&prog="+ prog + "&param=" + param + "'>" + name + "</a>" ;
		return a ;
	}
		
	var app2 = new Vue({
		el: '#app-3', 
		data: function(){
			return { 
				modalObject : [] ,  
				catm: '<?php echo $catm ; ?>' , 
				catmObj:{
					aalist : [] ,
					cc : {},
					aa : {},
					tt : {},
					mm : {}, 
				} ,
				footerData : {
					test : "" ,
				} 
			} 
  	}, 
    created() {
		  //////****  NEWS  ****//////
        funcs.getApiData('news', this.catm )
          .then((responseData) => { 
					console.log('news',responseData);	
					let a = responseData; 
					let ret = a.map(function(x){
						let allNews = {
							type	: "recruit_" , 
							subType	: "1"  ,
							// name 	: common_url + x.NEWS_TOPIC  + "</a>", 
							name 		: genLink( x.NEWS_TOPIC , ccaattmm , "news" , "/"+x.NEWS_ID ), 
							detail 	: x.NEWS_DETAIL , 
							date 	: x.ADD_DATE , 
							id 		: x.NEWS_ID , 
							prog 	: "news"
						}
					return  allNews ;
				}) 
			// data_sale.push(ret); 
			data_sale = ret ;
			});

			funcs.getApiData('proj', this.catm )
			.then((responseData) => {
				console.log('proj',responseData); 
			  let a = responseData;  
			  let ret = a.map(function(x){
				  let allNews = {
					  type	: "recruit_" , 
					  subType	: x.PROJECT_TYPE  ,
					//   name 		: common_url + x.PROJECT_NAME  + "</a>" , 
					  name 		: genLink( x.PROJECT_NAME , ccaattmm , "proj" , "/"+x.PROJECT_ID ), 
					  detail 	: x.PROJECT_NAME , 
					  date 		: x.ADD_DATE  , 
					  id 		: x.PROJECT_ID , 
					  prog 		: "proj"
				  }
				  data_sale.push(allNews)
				  return  allNews ;
			  })  
			})
				funcs.getApiData('procure', this.catm )
				.then((responseData) => { 
					let a = responseData; 
					console.log('procure',responseData);
					// console.log("newsAPI proc" ,  a , data_sale) 
					let ret = a.map(function(x){
					let allNews = {
						type	: "procure_" , 
						subType	: x.PROCUREMENT_TYPE  ,
						name	: genLink( x.PROCUREMENT_TOPIC , ccaattmm , "procure" , "/"+x.PROCUREMENT_ID ), 
						detail: 	 x.PROCUREMENT_TOPIC , 
						date	: x.ADD_DATE  , 
						id 		: x.PROCUREMENT_ID , 
						prog : "procure"
					}
					data_sale.push(allNews)
					genNewTable();
					return  allNews ;
				})
				
			})  
		   
      funcs.getApiData('gen', this.catm )
        .then((responseData) => {
        let [a] = responseData;
        obj.footerData = a ;   
      })  

      funcs.getApiData('ccaattmm/listCC', ''  )
          .then((responseData) => {
            let a = responseData;
            let [obj_c] = a.filter(function(x){
              return x.cc_code == obj.catm.substr(0,2);
			
					}); 

				obj.catmObj.cc = {
					desc : "จังหวัด"+ obj_c.cc_desc ,
					code : obj_c.cc_code ,
				}
			});

			funcs.getApiData('ccaattmm/listAA' , obj.catm.substr(0,2)   )
			  .then((responseData) => {
					//   obj.catmObj.aalist =  responseData ;
					let a = responseData ; 
				  	obj.catmObj.aalist = a.map(function(x){ 
						  let b = x ;
						  	    b.link = "./view2.php?catm=" + obj.catm.substr(0,2) + x.aa_code ;
						  return b ;
					});   
			})   
			}
	})
</script>
</body>


</html>


