//alert("the function had called!");
//var state;
function tab_menu(nav_id,url){
    //alert("called the function");
    var main_id=document.getElementById("main_menu");
    var gettagdiv=main_id.getElementsByTagName("div");
    for(i=0;i<gettagdiv.length;i++){
        var gettagtd=gettagdiv[i].getElementsByTagName("td");
        for(j=0;j<gettagtd.length;j++){
            if(j==0){var classtd="left-bt";}
            if(j==1){var classtd="center-bt";}
            if(j==2){var classtd="right-bt";}
            //alert(classtd);
            gettagtd[j].className=classtd;
        }
    }
    var getid_name=document.getElementById(nav_id);
    var get_work_area=document.getElementById("work_frame");
    if(url!=null){
        get_work_area.src=url;
    }
    else{
        //var are_id=document.getElementById("sub_menu");
        for(t=1;t<=4;t++){
            var item="menu"+t+"_sub";
            var edit=document.getElementById(item);
            edit.style.display="none";
        }
        var show_id=nav_id+"_sub";
        var get_id_show=document.getElementById(show_id);
        get_id_show.style.display="";
    }
    var gettagtdinuse=getid_name.getElementsByTagName("td");
    for(j=0;j<gettagtdinuse.length;j++){
            if(j==0){var classtd="left-bt-use";}
            if(j==1){var classtd="center-bt-use";}
            if(j==2){var classtd="right-bt-use";}
            //alert(classtd);
            gettagtdinuse[j].className=classtd;
    }
}
function them_kho(){
    
}
function sub_mouseover(nav_id,id_hover){
    var getid=document.getElementById(nav_id);
    //alert(nav_id);
    var arrtd=getid.getElementsByTagName("div");
    for(i=0;i<arrtd.length;i++){
        var arr=arrtd[i].getElementsByTagName("td");
        if(arr[0].className!="main_back" && arr[1].className!="right_back"){
            arr[0].className="normal";
            arr[1].className="right_normal";
        }
        
        
    }
    var getid_hover=document.getElementById(id_hover);
    var gettd_hover=getid_hover.getElementsByTagName("td");
    if(gettd_hover[0].className!="main_back" && gettd_hover[1].className!="right_back"){
        gettd_hover[0].className="main_hover";
        gettd_hover[1].className="right_normal";
    }
    
}
function sub_mouseout(nav_id,id_hover){
    var getid=document.getElementById(nav_id);
    //alert(nav_id);
    var arrtd=getid.getElementsByTagName("div");
    for(i=0;i<arrtd.length;i++){
        var arr=arrtd[i].getElementsByTagName("td");
        if(arr[0].className!="main_back" && arr[1].className!="right_back"){
            arr[0].className="normal";
            arr[1].className="right_normal";
        }
        
        
    }

    
}
function sub_mouseclick(nav_id,id_hover,url){
    var getid=document.getElementById(nav_id);
    //alert(nav_id);
    var arrtd=getid.getElementsByTagName("div");
    for(i=0;i<arrtd.length;i++){
        var arr=arrtd[i].getElementsByTagName("td");
            arr[0].className="normal";
            arr[1].className="right_normal";
        
        
    }
    var getid_hover=document.getElementById(id_hover);
    var gettd_hover=getid_hover.getElementsByTagName("td");
        gettd_hover[0].className="main_back";
        gettd_hover[1].className="right_back";
    var get_work_area=document.getElementById("work_frame");
    get_work_area.src=url;
}
function check(kho){
	
	if(confirm("ban co muon xoa \'"+kho+"\' khong")){
		
		return true;
	}
	else{
		return false;
	}
	
}
function show_form(){
	var get=document.getElementById("form2");
	var get2=document.getElementById("form1");
    var get3=document.getElementById("form3");
	get.style.display="";
	
	get2.style.display="none";
    get3.style.display="none";
	
}
function check_form(){
    //alert("goi duoc ham");
    var getform=document.them_laoi_hang.ten_loai.value;
    if(getform==""){
	alert("Nhap vao ten loai");
	return false;
    }
    return true;
}
function showdata(area){
    //alert("thay doi");
    var get=document.nhapkho.nhan_vien.length;
    //var getoption=document.nhapkho.nhan_vien.selectedIndex.value;
    var getoption=document.nhapkho.nhan_vien.options[nhapkho.nhan_vien.selectedIndex].value;
    //alert(getoption);
    var areaget=document.getElementById(area);
    areaget.src="show_combobox.php?ma_nv="+getoption;

    //alert(get);
}
function checkall(){
    //alert("goi duoc ham");
    var getchecbox=document.list_hang["chon[]"].length;
    for(i=0;i<getchecbox;i++){
        document.list_hang["chon[]"][i].checked=true;
    }
}
function uncheckall(){
    //alert("goi duoc ham");
    var getchecbox=document.list_hang["chon[]"].length;
    for(i=0;i<getchecbox;i++){
        document.list_hang["chon[]"][i].checked=false;
    }
}
function check_xoa(){
    var check_variable=0;
    var getchecbox=document.list_hang["chon[]"].length;
    //alert(getchecbox);
    if(getchecbox==undefined){
        check_variable=1;
    }
    else{
        for(i=0;i<getchecbox;i++){
            if(document.list_hang["chon[]"][i].checked==true){
                check_variable=1;
                //alert("trong for"+check_variable);
            }
        }
        
    }
    //alert("ngoai for"+check_variable);
    if(check_variable==1){
        //alert("dung roi");
        return true;
        
    }
    else{
        alert("Chon mau tin can xoa");
        return false;
    }
}
function tim_phieu_nhap(){
    //alert("thay doi");
    var get=document.nhapkho.so_phieu.length;
    //var getoption=document.nhapkho.nhan_vien.selectedIndex.value;
    var getoption=document.nhapkho.so_phieu.options[nhapkho.so_phieu.selectedIndex].value;
    //alert(getoption);
    //var areaget=document.getElementById(area);
    window.location="xemphieunhap.php?ma_pn="+getoption;

    //alert(get);
}
function check_print(){
    var getoption=document.nhapkho.so_phieu.options[nhapkho.so_phieu.selectedIndex].value;
    if(getoption=="null"){
        alert("Vui long chon phieu de in!");
        return false;
    }
    return true;
}
var clock1=new Date();
function Clock2(){
	var clock1=new Date();
    var x="AM";
	var gio=clock1.getHours();
	var phut=clock1.getMinutes();
	var giay=clock1.getSeconds();
	if(gio >12)
	{
		gio=gio%12;
		x="PM";
	}
    if(gio==0)gio=12;
    if(phut<=9)phut="0"+phut;
    if(giay<=9)giay="0"+giay;
	var dongho=gio+" : "+phut+" : "+giay+" "+x;
    document.getElementById('clock').innerHTML=dongho;
    t=setTimeout("Clock2()",1000);
   }
function doi_mau_hang(id_hang,mau){
    var get=document.getElementById(id_hang);
    get.style.background=mau;
}
function huy_mau_hang(id_hang){
    var get=document.getElementById(id_hang);
    get.style.background="#ffffff";
}
function setvitrihopthoai(){
    var get = document.getElementById("hopthoai");
    if(get.offsetHeight > 100)
    {
        get.style.height = 100;
        get.style.overflow = "auto";
    }
}
function searchkey(id_eara){
    //alert("goi ham");
    var ma = document.nhapkho.so_phieu.value;
    var get=document.getElementById(id_eara);
    get.src="hienthimanv.php?ma_pn="+ma;
    
}
function checkkhachhang()
{
    kq = true;
    hoten = document.getElementById('hoten').value;
    diachi = document.getElementById('diachi').value;
    sodienthoai = document.getElementById('sodienthoai').value;
    if(hoten =="")
    {
        alert("ho ten khong duoc rong !");
        kq = false;
    }
    else{ 
        if(hoten != "")
            {
                if(diachi == "" ||diachi.length <10)
            {
                kq = false;
                alert("dia chi khong rong va phai tren 10 ky tu !");
            }
            else {
                if(diachi != "" ||diachi.length >10)
            {
                if(sodienthoai =="" || sodienthoai.length < 10 || sodienthoai.lenghth > 13)
                {
                    alert("so dien thoai phai tu 10 den 13 so !");
                    kq = false;
                }
            }
            }
    }
    }
    return kq;
}
function checkkho()
        {
            kq =  true;
            makho = document.getElementById('makho').value;
            tenkho = document.getElementById('tenkho').value;
            diachi = document.getElementById('diachi').value;
            sdt = document.getElementById('sdt').value;
            if(makho == "" || makho.length != 5)
            {
                alert("ma kho khong duoc rong va phai bat dau la KH + so !");
                kq = false;
            }
            else
            {
                if(makho != "" || makho.length == 5)
                {
                    if(tenkho=="")
                    {
                        alert("ten kho khong duoc rong !");
                        kq = false;
                    }
                    else
                    {
                        if(tenkho!="")
                        {
                            if(diachi =="" || diachi.length<10)
                            {
                                alert("dia chi khong duoc rong va phai lon hon 10 ky tu!");
                                kq = false;
                            }
                            else
                            {
                            	var str=/^(\+\d{1,3}?)?(\(\d{1,5}\)|\d{1,5})?\d{3}?\d{0,7}(\.??\d{1,5})?$/;
                            	if(!sdt.match(str)||sdt.length<10||sdt.length>13)
                            	{
                            		kq=false;
                            		alert("so dien thoai khong hop le");
                            	}
                            }
                        }
                    }
                }
                
            }
            return kq;
        }
function checkncc()
        {
            kq =  true;
            tenncc = document.getElementById('tenncc').value;
            diachincc = document.getElementById('diachincc').value;
            sdtncc = document.getElementById('sdtncc').value;
            emailncc = document.getElementById('emailncc').value;
            mail =/^[A-z_][\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
            if(tenncc == "" )
            {
                alert("vui long nhap ten nha cung cap !");
                kq = false;
            }
            else
            {
                    if(diachincc=="")
                    {
                        alert("vui long nhap dia chi nha cung cap !");
                        kq = false;
                    }
                    else
                    {
                            var str=/^(\+\d{1,3}?)?(\(\d{1,5}\)|\d{1,5})?\d{3}?\d{0,7}(\.??\d{1,5})?$/;
                            	if(!sdtncc.match(str)||sdtncc.length<10||sdtncc.length>13)
                            	{
                            		kq=false;
                            		alert("so dien thoai khong hop le");
                            	}
                            else
                            {
									if(!emailncc.match(mail))
									 {
														   alert("vui long nhap mail lai cho dung!");
														   kq = false;
													      }
                                } 
                }
                
            }
            return kq;
        }
function checkhanghoa()
{
            kq =  true;
            tenhang = document.getElementById('tenhang').value;
            nhanhieu = document.getElementById('nhanhieu').value;
            hansudung = document.getElementById('hansudung').value;
            quycach = document.getElementById('quycach').value;
            dongia = document.getElementById('dongia').value;
            fileanh = document.getElementById('fileanh').value;
            if(tenhang == "" )
            {
                alert("vui long nhap ten hang hoa ban muon them !");
                kq = false;
            }
            else
            {
                    if(nhanhieu == "")
                    {
                        alert("vui long nhap nhan hieu cho hang hoa cua ban !");
                        kq = false;
                    }
                    else
                    {
                            if(hansudung == "")
                                {
                                    alert("nhap vao ngay het han cua hang hoa cua ban !");
                                    kq = false;
                                }
                            else
                            {
									if(quycach == "")
									 {
									            alert("vui long nhap quy cach cho hang hoa nay !");
                                                kq = false;
													      }
                                                    else
                                                    {
                                                            var str=/^\d*(\.\d+)?$/;
                                                            	if(!dongia.match(str))
                                                            	{
                                                            		kq=false;
                                                            		alert("so khong hop le");
                                                            	}
                                                              else
                                                              {
                                                                    if(fileanh == "")
        									                         {
            														   alert("vui long them hinh anh cho hang hoa nay !");
            														   kq = false;
            													      }
                                                                }
                                                       }
                             } 
                       }
                
            }
            return kq;
}
function checknhanvien()
{
    kq = true;
    ma_nv = document.getElementById('ma_nv').value;
    ten_nv = document.getElementById('ten_nv').value;
    tai_khoan = document.getElementById('tai_khoan').value;
    mat_khau = document.getElementById('mat_khau').value;
    ngay_sinh = document.getElementById('ngay_sinh').value;
    sdt = document.getElementById('sdt').value;
    dia_chi = document.getElementById('dia_chi').value;
    if(ma_nv == ""|| ma_nv.length!=5)
            {
                alert("ma nhan vien khong duoc rong va co chieu dai 5 ki tu NV + so!");
                kq = false;
            }
            else
            {
                    if(ten_nv == "")
                    {
                        alert("vui long nhap ten nhan vien can them !");
                        kq = false;
                    }
                    else
                    {
                            if(tai_khoan == ""||tai_khoan.length>20)
                                {
                                    alert("tai khoan cua nhan vien khong duoc rong va phai nho hon 20 ki tu !");
                                    kq = false;
                                }
                            else
                            {
									if(mat_khau == ""||mat_khau.length<6)
									 {
									            alert("mat khau phai tu 6 ki tu!");
                                                kq = false;
													      }
                                                    else
                                                    {
                                                            if(ngay_sinh == "")
									                         {
    														   alert("vui long nhap ngay sinh theo dang dd-mm-yyyy!");
    														   kq = false;
    													      }
                                                              else
                                                              {
                                                                    var str=/^(\+\d{1,3}?)?(\(\d{1,5}\)|\d{1,5})?\d{3}?\d{0,7}(\.??\d{1,5})?$/;
                                                                    	if(!sdt.match(str)||sdt.length<10||sdt.length>13)
                                                                    	{
                                                                    		kq=false;
                                                                    		alert("so dien thoai khong hop le");
                                                                    	}
                                                                      else
                                                                      {
                                                                       if(dia_chi=="")
                                                                       {
                                                                        alert("vui long nhap dia chi cua nhan vien!");
            														   kq = false;
                                                                       }
                                                                      }
                                                                }
                                                      }
                             } 
                       }
                
            }
            return kq;
}
function checkchucvu()
{
	kq = true;
	macv = document.getElementById('ma_cv').value;
	tencv = document.getElementById('ten_cv').value;
	if(macv =="")
	{
		alert("ma chuc vu khong duoc rong !");
		kq = false;
	}
	else{
		if(tencv == "")
		{
			alert("vui long nhap ten chuc vu can them !");
			kq = true;
		}
	}
	return kq;
}
function checkphieunhap()
{
	kq = true;
	so_phieu = document.getElementById('so_phieu').value;
	if(so_phieu =="" || so_phieu.length <5)
	{
		alert("vui long nhap so phieu chieu dai lon hon 5, bat dau PN + so");
		kq = false;
	}
	return kq;
}
function ajaxFunction()
		 {
			 var get=document.getElementById('sophieu');
			 if(get.style.display=="none")
			 {
				 get.style.display="";
			 }
			 
			var xmlHttp;
			try
			{
				//Firefox,opera 8.0+,Safari
				xmlHttp=new XMLHttpRequest();
			}
			catch(e)
			{
				//internet Explore
				try
				{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e)
				{
					try
					{
						xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch(e)
					{
						alert("Your browser does not support AJAX!");
						return false;
					}
				}
		   }
		   var sp=document.getElementById('so_phieu').value;
			xmlHttp.onreadystatechange = function()
				{
				  if(xmlHttp.readyState == 4)
				   {
					  document.getElementById('sophieu').innerHTML = xmlHttp.responseText;
				   }
				}
				xmlHttp.open("GET","load.php?id="+sp,true);
				xmlHttp.send(null);
			setvitrihopthoai();
		}
 function hiddenn()
 {
    setTimeout("hide2()",500);
			 
 }
 function hide2(){
	 var get=document.getElementById('sophieu');
			 
				 get.style.display="none";
	 }
 function setvitrihopthoai(){
	
    var get = document.getElementById("hopthoai");
	var get2 = document.getElementById("sophieu");
	 ///alert("hello");
    if(get.offsetHeight > 100)
    {
        get2.style.height = 100;
        //get2.style.overflowY = "scroll";
    }
	
}
function clickhang(id_ma){
			var get=document.getElementById(id_ma).value;
			document.getElementById("so_phieu").value=get;
			var get2=document.getElementById('sophieu');
			 
				 get2.style.display="none";
}