<style type="text/css">
button {
border: 1px solid #000000;
padding: 0px;
font-size: 4px;
margin-left: 1px;
}
button:hover {
cursor: pointer;
color: #ffffff;
}
#navbox {
border:1px solid black;
padding-left: 170px;
float: right;
clear: none;
padding: 0px;
min-width: 50%;
max-width: 69%;
}
#treeDiv1 {
max-height:300px;
overflow: auto;
background-color: #F0F0F0;
float:left;
right:5px;
top:5px;
border:1px solid black;
clear: none;
min-width: 20%;
max-width: 30%;
padding: 0px;
}
#expandcontractdiv {
border:1px dotted #dedede;
background-color:#EBE4F2;
margin:0 0 .5em 0;
padding:0.4em;
}
.majorsection {
float:left;
width:100%;
clear:both;
margin: 5px 0px;
padding: 0px 10px;
}
.sectiontext {
clear:both;
font-size: x-large;
}
.boxresult {
width: inherit;
border: 1px solid grey;
}
.boxgoodresult {
width: inherit;
margin: 5px auto;
border: 2px solid #0aff22;
}
.boxbadresult {
width: inherit;
margin: 5px auto;
border: 2px solid #ff3232;
}
.boxresultcol1 {
background-color: #FFFFFF;
float: left;
width: inherit;
margin: 5px auto;
margin-left: 10px;
word-wrap: break-word;
}
.boxresultcol2 {
margin-left: 20px;
}
.boxlink {
float:left;
width:130px;
}
.boxfreq {
float:left;
width:170px;
clear:both;
}
.boxmag {
float:left;
width:170px;
clear:both;
}
.boxrep {
float:left;
width:170px;
clear:both;
}
.boxeffect {
float:left;
padding: 5px;
}
.gsboxeffect {
float:left;
clear: none;
}
.boxshow {
float:left;
margin-left: 5px;
margin-top: 10px;
width:100px;
}
.rstext {
float:left;
clear: left;
background-color: #D0D0FF;
}
.diseasebutton {
margin-left: 20px;
margin-top: 10px;
float:left;
clear: both;
}
.member-Topic {
margin-left: 30px;
border:1px solid black;
clear: both;
}
.member-is-a-medical-condition {
margin-left: 30px;
border:1px solid black;
clear: both;
}
.member-is-a-medicine {
margin-left: 20px;
border:1px solid black;
clear: both;
}
.adiseasebox {
width: 100%;
float:left;
margin-left: 0px;
clear: both;
}
.diseaselink {
margin-left: 140px;
FONT-SIZE: 18pt;
}
.diseaseinfo {
float :right;
}
.boxfooter {
clear: both;
margin: 0;
border-top: 1px solid gray;
}
.majorboxfooter {
clear: both;
margin: 0;
border-top: 1px solid gray;
}
</style>

<script type="text/javascript">
function toggle(element) {
if (document.getElementById(element).style.display == "none") {
   document.getElementById(element).style.display = "";
} else {
   document.getElementById(element).style.display = "none";
}
}
function toggle2(element) {
if (document.getElementById(element).style.display == "none") {
   document.getElementById(element).style.display = "";
   document.getElementById('show-'+element).style.display = "none";
} else {
   document.getElementById(element).style.display = "none";
   document.getElementById('show-'+element).style.display = "";
}
}
function toggle3(name) {
var e=getElementsByClassName(name);
for ( var i=0; i < e.length; i++ ) {
   if (e[i].style.display == "none") {
       e[i].style.display = "";
       document.getElementById('show-'+e[i].id).style.display = "none";
   } else {
       e[i].style.display = "none";
       document.getElementById('show-'+e[i].id).style.display = "";
   }
}
}

/*

Need to switch to this cleaner method
Crockford walkTheDOM http://javascript.crockford.com/hackday.ppt

function walkTheDOM(node, func) {

func(node);
node = node.firstChild;
while (node) {
    walkTheDOM(node, func);
    node = node.nextSibling;
}

}


function getElementsByClassName(className, node) {
 var results = [];
 walkTheDOM(node || document.body, function (node) {
     var a, c = node.className, i;
     if (c) {
         a = c.split(' ');
         for (i = 0; i < a.length; i += 1) {
             if (a[i] === className) {
                  results.push(node);
                  break;
              }
         }
     }
 });
 return results;
}


By now there is a more efficient method, but once upon a time this javascript served well enough

    BEGIN:http://www.robertnyman.com
    http://www.robertnyman.com/2008/05/27/the-ultimate-getelementsbyclassname-anno-2008/
    cross platform 'getElementsByClassName'
    Developed by Robert Nyman, http://www.robertnyman.com
    Code/licensing: http://code.google.com/p/getelementsbyclassname/
*/
var getElementsByClassName = function (className, tag, elm){
    if (document.getElementsByClassName) {
            getElementsByClassName = function (className, tag, elm) {
                    elm = elm || document;
                    var elements = elm.getElementsByClassName(className),
                            nodeName = (tag)? new RegExp("\b" + tag + "\b", "i") : null,
                            returnElements = [],
                            current;
                    for(var i=0, il=elements.length; i<il; i+=1){
                            current = elements[i];
                            if(!nodeName || nodeName.test(current.nodeName)) {
                                    returnElements.push(current);
                            }
                    }
                    return returnElements;
            };
    }
    else if (document.evaluate) {
            getElementsByClassName = function (className, tag, elm) {
                    tag = tag || "*";
                    elm = elm || document;
                    var classes = className.split(" "),
                            classesToCheck = "",
                            xhtmlNamespace = "http://www.w3.org/1999/xhtml",
                            namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
                            returnElements = [],
                            elements,
                            node;
                    for(var j=0, jl=classes.length; j<jl; j+=1){
                            classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
                    }
                    try     {
                            elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
                    }
                    catch (e) {
                            elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
                    }
                    while ((node = elements.iterateNext())) {
                            returnElements.push(node);
                    }
                    return returnElements;
            };
    }
    else {
            getElementsByClassName = function (className, tag, elm) {
                    tag = tag || "*";
                    elm = elm || document;
                    var classes = className.split(" "),
                            classesToCheck = [],
                            elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
                            current,
                            returnElements = [],
                            match;
                    for(var k=0, kl=classes.length; k<kl; k+=1){
                            classesToCheck.push(new RegExp("(^|\s)" + classes[k] + "(\s|$)"));
                    }
                    for(var l=0, ll=elements.length; l<ll; l+=1){
                            current = elements[l];
                            match = false;
                            for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
                                    match = classesToCheck[
                                        m].test(current.className);
                                    if (!match) {
                                            break;
                                    }
                            }
                            if (match) {
                                    returnElements.push(current);
                            }
                    }
                    return returnElements;
            };
    }
    return getElementsByClassName(className, tag, elm);
};
/*      END:http://www.robertnyman.com */

function ShowEverything(){//we open all of them

var sections = new Array('diseasebox',
                     'member-is-a-Topic',
                     'member-is-a-medical-condition',
                     'member-is-a-medicine',
                     'rstext',
                     'boxrstext',
                     'boxshow',
                     'boxsection'
                     );

for ( var i_sect=0; i_sect < sections.length; i_sect++ ) {
    var e=getElementsByClassName(sections[i_sect]);
    for ( var i=0; i < e.length; i++ ) {
        e[i].style.display = '';
    }
}

}
</script>
	<?php
	    $filename = file_get_contents("../report/promethease_data/report_is-a-medicine.html");

        // Extract the div as a substring
		$start = (strrpos($filename, 'majorsection') - 12);
		$end = (strrpos($filename, 'boxfooter') + 42);
	    $extract = substr($filename, $start, ($end - $start));
        $start = null; $end = null; // null-ify vars

        // Remove the inline medicine div tag
        $extract = str_replace("<div class='sectiontext'>Medicines</div>", "", $extract);
        //$extract = str_replace("<p><br/></p></html>", "", $extract);


        // Remove the first (hide) button
        //$hideButtonStart = ((stripos($extract, ">(hide)<")) - 45);
        //$hideButtonEnd = ((stripos($extract, ">(hide)<")) + 11);
        //$targetStr = substr($extract,$hideButtonStart,($hideButtonStart-$hideButtonEnd));

        //echo str_replace($targetStr, "", $extract);

        echo $extract;
?>