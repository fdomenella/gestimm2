<script type="text/javascript">
function NewWindow(mypage,myname,w,h,scroll){
	var win = null;
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable';
	win = window.open(mypage,myname,settings);
	if(win.window.focus){
		win.window.focus();
	}
}
</script>