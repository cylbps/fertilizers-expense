function getXMLHTTPRequest() {
    var req = false;
    try {
        /*для Firefox*/
        req = new XMLHttpRequest();
    } catch (err) {
        try {
            /* для некоторых версий IE*/
            req = ActiveXObject("MsXML2.XMLHTTP");
        } catch (err) {
            try {
                /* для других версий IE*/
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err) {
                req = false;
            }
        }
    }
    return req;
}

function selectSubObjects(list, parentID) {
    var thePage = 'select_sub_objects.php';
    myRand = parseInt(Math.random() * 999999999999999);
    var theURL = thePage + "?list=" + list + "&parentid=" + parentID + "&rand=" + myRand;
    myReq.open("GET", theURL, true);
    myReq.onreadystatechange = HTTPSelectSubObjects;
    myReq.send(null);
}

function selectSowingArea(sowingID) {
    var thePage = 'select_sowing_area.php';
    myRand = parseInt(Math.random() * 999999999999999);
    var theURL = thePage + "?sowing_id=" + sowingID + "&rand=" + myRand;
    myReq.open("GET", theURL, true);
    myReq.onreadystatechange = HTTPSowingArea;
    myReq.send(null);
}

function selectSowings(fieldID) {
    var thePage = 'select_sowings.php';
    myRand = parseInt(Math.random() * 999999999999999);
    var theURL = thePage + "?field_id=" + fieldID + "&rand=" + myRand;
    myReq.open("GET", theURL, true);
    myReq.onreadystatechange = HTTPSelectSowings;
    myReq.send(null);
}

function selectDiviation(weight) {
    if (weight !== "") {
        var fertplan_id = document.getElementById("fert_plan").value;
        var total_area = document.getElementById("sowing_area_val").value;
        var thePage = 'select_diviation.php';
        myRand = parseInt(Math.random() * 999999999999999);
        var theURL = thePage + "?weight=" + weight + "&fert_plan=" +
                fertplan_id + "&sowing_area=" + total_area + "&rand=" + myRand;
        myReq.open("GET", theURL, true);
        myReq.onreadystatechange = HTTPDiviation;
        myReq.send(null);
    } else {
        return;
    }
}

function selectFertPlans(sowingID) {
    var thePage = 'select_fert_plans.php';
    myRand = parseInt(Math.random() * 999999999999999);
    var theURL = thePage + "?sowing_id=" + sowingID + "&rand=" + myRand;
    myReq.open("GET", theURL, true);
    myReq.onreadystatechange = HTTPSelectFertPlans;
    myReq.send(null);
}

function selectFertilizer(fertPlanID) {
    var thePage = 'select_fertilizer.php';
    myRand = parseInt(Math.random() * 999999999999999);
    var theURL = thePage + "?fert_plan_id=" + fertPlanID + "&rand=" + myRand;
    myReq.open("GET", theURL, true);
    myReq.onreadystatechange = HTTPSelectFertilizer;
    myReq.send(null);
}

function HTTPSelectFertilizer() {
    if (myReq.readyState === 4) {
        if (myReq.status === 200) {
            var outStr =
                    myReq.responseText;
            document.getElementById('fertilizer').value = outStr;
            if (document.getElementById('treated_area_input').type !== "hidden") {
                selectDiviation(document.getElementById('weight').value);                
            }
        }
    }
}

function HTTPSelectFertPlans() {
    if (myReq.readyState === 4) {
        if (myReq.status === 200) {
            var outStr =
                    myReq.responseText;
            //alert(myReq.responseText);
            document.getElementById('fert_plan').innerHTML =
                    outStr;

        }
    }
}

function HTTPSelectSubObjects() {
    if (myReq.readyState === 4) {
        if (myReq.status === 200) {
            var outStr =
                    myReq.responseText;
            document.getElementById('fields').innerHTML =
                    outStr;
            document.getElementById('sowings').innerHTML =
                    '<option></option>';
            document.getElementById('fert_plan').value = "empty";
            if (document.getElementById('treated_area_input').type !== "hidden") {
                document.getElementById('treated_area').innerHTML =
                        '<input type="text" id="treated_area_input" name="treated_area">';
                document.getElementById('weight_td').innerHTML =
                        '<input type="text" name="weight" onchange="javascript:selectDiviation(this.value);">';
                document.getElementById('sowing_area').innerHTML =
                        '<input id="sowing_area_val" type="text" name="total_area" readonly="readonly">';
                document.getElementById('deviation_td').innerHTML =
                        '<input type="text" name="deviation_val" readonly="readonly">';
                document.getElementById('fertilizer').value = "";
            }
        }
    }
}

function HTTPSowingArea() {
    if (myReq.readyState === 4) {
        if (myReq.status === 200) {
            var outStr =
                    myReq.responseText;
            if (document.getElementById('treated_area_input').type !== "hidden") {
                document.getElementById('sowing_area').innerHTML =
                        outStr;
                document.getElementById('treated_area').innerHTML =
                        '<input type="text" id="treated_area_input" name="treated_area">';
                document.getElementById('weight_td').innerHTML =
                        '<input type="text" id="weight" name="weight" onchange="javascript:selectDiviation(this.value);">';
                document.getElementById('fert_plan').value = "empty";
                document.getElementById('deviation_td').innerHTML =
                        '<input type="text" name="deviation_val" readonly="readonly">';
                document.getElementById('fertilizer').value = ""; 
                
                selectFertPlans(document.getElementById('sowings').value); 
            }else {
                selectFertPlans(document.getElementById('sowings').value);   
            }
            
            
        }
    }
}

function HTTPSelectSowings() {
    if (myReq.readyState === 4) {
        if (myReq.status === 200) {
            var outStr =
                    myReq.responseText;
            document.getElementById('sowings').innerHTML =
                    outStr;
            if (document.getElementById('treated_area_input').type !== "hidden") {
                document.getElementById('treated_area').innerHTML =
                        '<input type="text" id="treated_area_input" name="treated_area">';
                document.getElementById('weight_td').innerHTML =
                        '<input type="text" id="weight" name="weight" onchange="javascript:selectDiviation(this.value);">';
                document.getElementById('fert_plan').value = "empty";
                document.getElementById('sowing_area').innerHTML =
                        '<input id="sowing_area_val" type="text" name="total_area" readonly="readonly">';
                document.getElementById('deviation_td').innerHTML =
                        '<input type="text" name="deviation_val" readonly="readonly">';

                document.getElementById('fertilizer').value = "";
            }
        }
    }
}

function HTTPDiviation() {
    if (myReq.readyState === 4) {
        if (myReq.status === 200) {
            var outStr =
                    myReq.responseText;


            var fertPlan = document.getElementById("fert_plan").value;
            if (fertPlan) {
                document.getElementById('deviation_td').innerHTML =
                        outStr;
            } else {
                document.getElementById('deviation_td').innerHTML =
                        '<input type="text" name="diviation_val" readonly="readonly">';
            }

        }
    }
}
