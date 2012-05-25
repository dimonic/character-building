function makeWin2(url) {  // pop up window for <autocard> tag

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=220,";
              params += "height=310";

              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}

function MTGOStatusWin() {  // pop up window for MTGO Status from x=magic/magiconline
			 // alert("This works");
              agent = navigator.userAgent;
			  url = "/magic/magiconlineserverstatus.asp"
			  nHorz = 225;
			  nVert = 220;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=no,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=no,";
              params += "scrollbars=no,";
              params += "resizable=yes,";
              params += "width=" + nHorz + ",";
              params += "height=" + nVert;

              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}

function autoCardWindow(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
//              params += "scrollbars=0,";
//              params += "resizable=0,";
//              params += "width=455,";
//              params += "height=480";
              params += "scrollbars=1,";
              params += "resizable=1,";
              params += "width=700,";
              params += "height=500";

//              win = window.open("/magic/autocard.asp?name="+cardname, windowName , params);

//              win = window.open("http://gatherer.wizards.com/gathererlookup.asp?name="+cardname, windowName , params);
              win = window.open("http://ww2.wizards.com/Gatherer/CardDetails.aspx?name="+cardname, windowName , params);

//              if (!win.opener) {
//                  win.opener = window;
//              }

}

function autoCardWindow2(cardname, set) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
//              params += "scrollbars=0,";
//              params += "resizable=0,";
//              params += "width=455,";
//              params += "height=480";
              params += "scrollbars=1,";
              params += "resizable=1,";
              params += "width=700,";
              params += "height=500";

//              win = window.open("/magic/autocard.asp?url="+url+"&name="+cardname, windowName , params);   // old autocard window, pre-Gatherer

//              win = window.open("http://gatherer.wizards.com/gathererlookup.asp?name="+cardname+"&set="+set, windowName, params);
              win = window.open("http://ww2.wizards.com/Gatherer/CardDetails.aspx?name="+cardname+"&set="+set, windowName, params);
              if (!win.opener) {
                  win.opener = window;
              }

}

function autoCardWindowJP(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=455,";
              params += "height=480";

              win = window.open("/magic/autocardjp.asp?name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}

function autoCardWindowSR(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=210,";
              params += "height=295";

              win = window.open("/scoutingreport/autocard.asp?name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}

function autoCardWindowSR2(cardname,url) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=210,";
              params += "height=295";

               win = window.open("/scoutingreport/autocard.asp?url="+url+"&name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}

function PKautoCardWindow(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=465,";
              params += "height=550";

              win = window.open("/pokemon/pkautocard.asp?name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}

function NPautoCardWindow(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=460,";
              params += "height=500";

              win = window.open("/neopets/npautocard.asp?name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}

function GIJOEautoCardWindow(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=460,";
              params += "height=500";

              win = window.open("/gijoetcg/gijoeautocard.asp?name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}


function DMautoCardWindow(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "lookupwin";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=600,";
              params += "height=490";

              win = window.open("/duelmasters/dm_autocard.asp?name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}

function HTautoCardWindow(cardname) {  // pop up window for <htcard> 

              agent = navigator.userAgent;
              windowName = "lookupwin";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=680,";
              params += "height=520";

              win = window.open("/hecatomb/ht_autocard.asp?name="+cardname, windowName , params);

              if (!win.opener) {
                  win.opener = window;
              }

}

function pokemonSurvey() { //pop up window for the pokemon survey
		
			agent = navigator.userAgent;
			windowName = "survey";
			
			params = "";
			params += "toolbar=0,";
            params += "location=0,";
			params += "directories=0,";
            params += "status=1,";
            params += "menubar=0,";
            params += "scrollbars=0,";
            params += "resizable=1,";
            params += "width=300,";
            params += "height=320";

            win = window.open("/pokemon/pokemon1.htm");

              if (!win.opener) {
                  win.opener = window;
              }

}

function SWTCGautoCardWindow(cardname) {  // pop up window for <swtcgautocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=245,";
              params += "height=335";

              win = window.open("/swtcg/swtcg_autocard.asp?name="+cardname, windowName , params);
				
              if (!win.opener) {
                  win.opener = window;
              }

}

function SWTCGautoCardWindowLandscape(cardname) {  // pop up window for <autocard> tag - with drop shadows

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
              params += "width=330,";
              params += "height=245";

              win = window.open("/swtcg/swtcg_autocard.asp?name="+cardname, windowName , params);
			  	
              if (!win.opener) {
                  win.opener = window;
              }

}

function SWMINISautoCardWindow(cardnumber) {  // pop up window for <swminisautocard> tag 

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=0,";
			  params += "width=350,";
              params += "height=660";

              win = window.open("/swminis/swminis_autocard.asp?name="+cardnumber, windowName , params);
				
              if (!win.opener) {
                  win.opener = window;
              }

}




function makeWin3(url) {  // pop up larger window than <autocard>, for <glossary> tag

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=1,";
              params += "resizable=1,";
              params += "width=250,";
              params += "height=350";

              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}

function makeWinXY(url, nWidth, nHeight) {  // pop up window with height/width

              agent = navigator.userAgent;
              windowName = "xywindow";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=1,";
              params += "resizable=1,";
              params += "width=" + nWidth + ",";
              params += "height=" + nHeight;

              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}

function makeWinXY2(name, url, nWidth, nHeight) {  // pop up window with height/width

              agent = navigator.userAgent;
              windowName = name;

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=1,";
              params += "resizable=1,";
              params += "width=" + nWidth + ",";
              params += "height=" + nHeight;

              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}


function makeWinQuiz() {  // pop up window for <autocard> tag

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=1,";
              params += "resizable=0,";
              params += "width=787,";
              params += "height=580";

			  url = "/default2.asp?x=pokemon/professortest1&qnum=1&start=true"	
              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}

function makeWinQuizIT() {  // pop up window for <autocard> tag

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=1,";
              params += "resizable=0,";
              params += "width=787,";
              params += "height=580";

			  url = "/default2.asp?x=pokemon/professortest1it&qnum=1&start=true"	
              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}

function makeWinQuizFR() {  // pop up window for <autocard> tag

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=1,";
              params += "resizable=0,";
              params += "width=787,";
              params += "height=580";

			  url = "/default2.asp?x=pokemon/professortest1fr&qnum=1&start=true"	
              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}

function makeWinQuizNL() {  // pop up window for <autocard> tag

              agent = navigator.userAgent;
              windowName = "Sitelet";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,";
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=1,";
              params += "resizable=0,";
              params += "width=787,";
              params += "height=580";

			  url = "/default2.asp?x=pokemon/professortest1nl&qnum=1&start=true"	
              win = window.open(url, windowName , params);

              if (agent.indexOf("Mozilla/2") != -1 &&
agent.indexOf("Win") == -1) {
                  win = window.open(url, windowName , params);
              }

              if (!win.opener) {
                  win.opener = window;
              }

}


function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v3.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function pulldown(formObj)
	{
		url = formObj.options[formObj.options.selectedIndex].value;
		if(url != "empty")
			{
			window.location = url;
			url = "";
			}
	}
	

// This checks to see if the window's dimensions have actually changed
// (because Netscape often fires a false onResize event when it forms scrollbars);
// if they have, the document is reloaded.
// Note that document.location is not supposed to be settable, but here's another
// case where the implementation does not match the specs.

function resizeFix(){
  if(document.resizeFix.initWidth!=window.innerWidth
   ||document.resizeFix.initHeight!=window.innerHeight)
      document.location=document.location;
}

// This function checks to see if the browser supports the Layer object (i.e., Netscape 4.X);
// if it does, then it creates a new object with properties to hold the current window width & height
// and assigns the resizeFix() function to the window's onResize event

function checkBrowser(){
  if(document.layers){
    if(typeof document.fix == "undefined"){
      document.resizeFix=new Object();
      document.resizeFix.initWidth=window.innerWidth;
      document.resizeFix.initHeight=window.innerHeight;
    }
    window.onresize=resizeFix;
  }
}

// This calls the browser check function above

checkBrowser();


// This is a function for a TV House webcast pop-up window
function video_window(url) {
window.open(url,"tvh201","toolbar=0,titlebar=no,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=445,height=600,left=50,top=10");
}

// Function to open window to a set size
function MM_openBrWindow(theURL,winName,features) {
  window.open(theURL,winName,features);
}

function popupPageleave(URL){
	self.name = "main"; aWindow=window.open(URL,"thewindow","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=500,height=450");
}


function VerifyForm (formName) {
	var i, elementName, okay, emailtry;
	
	okay = true;
	
	for (i=0; i<document.forms[formName].elements.length; i++) {
		if (document.forms[formName].elements[i].name.indexOf("hiddenrequired",0) > -1) {
			elementName = document.forms[formName].elements[i].value;
			if (document.forms[formName].elements[elementName].value == "") {
				document.forms[formName].elements[elementName].focus();
				alert("The \"" + elementName + "\" field is required.  Please enter a value.");	
				okay = false;
				break;
			}
		}
		if (document.forms[formName].elements[i].name.indexOf("hiddencustom",0) > -1) {
			elementName = document.forms[formName].elements[i].value;
			if (document.forms[formName].elements[elementName].value == "") {
				document.forms[formName].elements[elementName].focus();
				alert(document.forms[formName].elements[i].getAttribute('message'));	
				okay = false;
				break;
			}
		}		
		if (document.forms[formName].elements[i].name.indexOf("hiddenemail",0) > -1) {
			elementName = document.forms[formName].elements[i].value;
			emailtry = document.forms[formName].elements[elementName].value;
			if ( !emailtry.match (/[\w\.]*\@[\w.]*.[\w]*/) ) {
				document.forms[formName].elements[elementName].focus();
				alert("The \"" + elementName + "\" field requires a valid email address.  Please correct the address entered and submit again.");	
				okay = false;
				break;
			}
		}
	}
	if (okay) {
		document.forms[formName].submit();
	}

}




function autoGlossaryWindow(glossaryterm) {  // pop up window for <glossary> tag D&D

              agent = navigator.userAgent;
              windowName = "GlossaryPop";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,"; 
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=yes,";
              params += "width=550,";
              params += "height=480";

              win = window.open("/default.asp?x=dnd/gloss/window&amp;term="+glossaryterm+"&amp;alpha=", windowName , params);

}

function autoGlossaryWindowHT(glossaryterm) {  // pop up window for <glossary> tag  Hecatomb

              agent = navigator.userAgent;
              windowName = "GlossaryPopHT";

              params  = "";
              params += "toolbar=0,";
              params += "location=0,";
              params += "directories=0,"; 
              params += "status=0,";
              params += "menubar=0,";
              params += "scrollbars=0,";
              params += "resizable=yes,";
              params += "width=550,";
              params += "height=480";

              win = window.open("/default.asp?x=ht/gloss/window&amp;term="+glossaryterm+"&amp;alpha=", windowName , params);

}


function reveal_collapse (object) {
  if (document.getElementById) {
    document.getElementById(object).style.display = 'block';
  }
  else if (document.layers && document.layers[object]) {
    document.layers[object].display = 'block';
  }
  else if (document.all) {
    document.all[object].style.display = 'block';
  }
}




function global_reveal_layer (object) {
  if (document.getElementById) {
    document.getElementById(object).style.visibility = 'visible';
  }
  else if (document.layers && document.layers[object]) {
    document.layers[object].visibility = 'visible';
  }
  else if (document.all) {
    document.all[object].style.visibility = 'visible';
  }
}

function global_hide_layer (object) {
  if (document.getElementById) {
    document.getElementById(object).style.visibility = 'hidden';
  }
  else if (document.layers && document.layers[object]) {
    document.layers[object].visibility = 'hidden';
  }
  else if (document.all) {
    document.all[object].style.visibility = 'hidden';
  }
}




// to alleviate blank search queries
function searchSubmit() {
value=document.Search.elements['sp-q'].value;

if ( value == "" ){
         
         return;
     }
     else {
     //return true;
	 self.document.Search.submit()
     }
}



