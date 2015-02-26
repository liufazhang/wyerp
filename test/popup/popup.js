/**
 * Created by user on 15-1-4.
 */

function popup(){
    var Width = $(document).width();
    var Height = $(document).height();
    var vWidth = $(window).width();
    var vHeight = $(window).height();
    var wHeight = document.documentElement.clientHeight;
    var oMask = document.createElement("div");
        oMask.id = "mask";
        oMask.style.height=Height+"px";
        oMask.style.width = Width+"px";
    document.body.appendChild(oMask);
}

function popupRemove(){
    document.body.remove(oMask);
}

