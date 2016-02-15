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
toggle2('is-a-medicine');
toggle2('is-a-medical-condition');
toggle2('is-a-tagcloud');
