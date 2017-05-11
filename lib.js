function selectCheckBox() {
    var btn = document.getElementById("check-uncheck-btn");

    var nodes = document.getElementsByTagName("INPUT");

    if (btn.getAttribute("class") === "check-btn") {
        btn.setAttribute("class", "uncheck-btn");

        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].type === "checkbox")
                nodes[i].checked = false;
        }
    } else if (btn.getAttribute("class") === "uncheck-btn") {
        btn.setAttribute("class", "check-btn");

        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].type === "checkbox")
                nodes[i].checked = true;
        }
    }
}

function printDoc() {
    window.print();
}

function fertExpWarning() {
    if (confirm("Выбраные данные будут удалены. Продолжить?"))
        document.getElementById("fert_action_form").submit();
}


