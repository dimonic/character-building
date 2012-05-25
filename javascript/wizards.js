function autoGlossaryWindow(glossaryterm)  // pop up window for <glossary> tag 
{
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

  win = window.open("http://www.wizards.com/default.asp?x=dnd/gloss/window&amp;term="+glossaryterm+"&amp;alpha=", windowName , params);

}