<script type="text/javascript">
function PreviewImage(Val)
{
    var miaImmagine = new Image();
    miaImmagine.src = document.mainForm.file.value.toLowerCase();
    var miaImmagineSrc = miaImmagine.src;
    var W =miaImmagine.width;
    var H =miaImmagine.height;

    var con = false;
    if (miaImmagineSrc.indexOf(".gif") < 0 && miaImmagineSrc.indexOf(".jpg") < 0 && miaImmagineSrc.indexOf(".png") < 0 && miaImmagineSrc.indexOf(".jpeg") < 0)
    {
        alert("Inserire solo i seguenti formati:\n- .gif \n- .jpg\n- .png");
    }
    else
    {
        if (Val == 1)
        {
            document.mainForm.submit();
        }
        else
        {
            document.img1.src = miaImmagine.src;
        }
    }
}


</script>