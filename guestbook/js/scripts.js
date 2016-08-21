//布局model
window.onload = function(){
	var model   = document.getElementById("model");
	var login   = document.getElementById('login');

	var mWidth  = model.offsetWidth < 400 ? 400 : model.offsetWidth;
	var mHeight = model.offsetHeight;

	var winW	= window.innerWidth;
	var winH	= window.innerHeight;

	var close   = document.getElementById("close");
	var loginclose   = document.getElementById("closelogin");
	
	var shade   = document.getElementById("shade");
	
	var register= document.getElementById("register");
	var registerClose = document.getElementById("closeResigster");



	model.style.left = Math.ceil((winW - mWidth) / 2) + "px";
	model.style.top  = Math.ceil((winH - mHeight) / 2) + "px";
	login.style.left = Math.ceil((winW - mWidth) / 2) + "px";
	login.style.top  = Math.ceil((winH - login.offsetHeight - 	100) / 2) + "px";
	
	register.style.left = Math.ceil((winW - mWidth) / 2) + "px";
	register.style.top  = Math.ceil((winH - login.offsetHeight - 	100) / 2) + "px";


	close.onclick = function(){
		if(shade.style.display === "none"){
			model.style.display = "block";
			shade.style.display = "block";
		}else{
			model.style.display = "none";
			shade.style.display = "none";
		}
	}
	loginclose.onclick = function(){
		if(shade.style.display === "none"){
			login.style.display = "block";
			shade.style.display = "block";
		}else{
			login.style.display = "none";
			shade.style.display = "none";
		}
	}
	registerClose.onclick = function(){
		if(shade.style.display === "none"){
			register.style.display = "block";
			shade.style.display = "block";
		}else{
			register.style.display = "none";
			shade.style.display = "none";
		}
	}
	
}
function openModel(contents){
	if(typeof contents !== "object") return;
	var title = document.getElementById("title");
	var content = document.getElementById("content");

	model.style.display = "block";
	shade.style.display = "block";

	title.innerHTML   = contents.title;
	content.innerHTML = contents.content;
}

function openlogin(){

	register.style.display="none";
	login.style.display = "block";
	shade.style.display = "block";
}
function showRegister(){
	
	login.style.display="none";
	register.style.display = "block";
	shade.style.display = "block";
}


