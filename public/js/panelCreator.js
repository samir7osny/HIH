function addPanelS(){
    let panels = $(".panel");
    for (let index = 0; index < panels.length; index++) {
        let element = panels.eq(index);
        $.ajax({
            url : "/js/panel.js",
            dataType: "text",
            success : function (data) {
                element.parent().append("<script>{let panelIndex=" + (index).toString() + ";" + data + "}</script>");
            }
        });
    }
}