
/*  Browser Detection  */

// Checks the browser and adds classes to the body to reflect it.

$(document).ready(function(){

    //alert('in abacalab.js document.ready') ; 
    
    var userAgent = navigator.userAgent.toLowerCase();
    $.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase()); 
    
    // Is this a version of IE?
    if($.browser.msie){
        $('body').addClass('browserIE');
        
        // Add the version number
        $('body').addClass('browserIE' + $.browser.version.substring(0,1));
    }
    
    
    // Is this a version of Chrome?
    if($.browser.chrome){
    
        $('body').addClass('browserChrome');
        
        //Add the version number
        userAgent = userAgent.substring(userAgent.indexOf('chrome/') +7);
        userAgent = userAgent.substring(0,1);
        $('body').addClass('browserChrome' + userAgent);
        
        // If it is chrome then jQuery thinks it's safari so we have to tell it it isn't
        $.browser.safari = false;
    }
    
    // Is this a version of Safari?
    if($.browser.safari){
        $('body').addClass('browserSafari');
        
        // Add the version number
        userAgent = userAgent.substring(userAgent.indexOf('version/') +8);
        userAgent = userAgent.substring(0,1);
        $('body').addClass('browserSafari' + userAgent);
    }
    
    // Is this a version of Mozilla?
    if($.browser.mozilla){
        
        //Is it Firefox?
        if(navigator.userAgent.toLowerCase().indexOf('firefox') != -1){
            $('body').addClass('browserFirefox');
            
            // Add the version number
            userAgent = userAgent.substring(userAgent.indexOf('firefox/') +8);
            userAgent = userAgent.substring(0,1);
            $('body').addClass('browserFirefox' + userAgent);
        }
        // If not then it must be another Mozilla
        else{
            $('body').addClass('browserMozilla');
        }
    }
    
    // Is this a version of Opera?
    if($.browser.opera){
        $('body').addClass('browserOpera');
    }
    
    
});


/*  Getting IE to do HTML5 properly  */

// For discussion and comments see 
// http://remysharp.com/2009/01/07/html5-enabling-script/
(function(){if (!/*@cc_on!@*/0) return;var e = "abbr,article,aside,audio,bb,canvas,datagrid,datalist,details,dialog,eventsource,fieldset,figure,footer,header,hgroup,label,mark,menu,meter,nav,output,progress,section,time,video".split(',');for(var i=0;i<e.length;i++){document.createElement(e[i])}})()



/*
    Make the specified H3 appear selected (darker grey background)
    by toggling the "selected" class.

    Also, any existing H3s that have the "selected" class are first 
    toggled so that they are no longer selected.

    To implement this:

    1) Presumably, you have a named anchor around the H3 so that the link knows where to go.
    2) Next, add a (unique) element ID to the H3 tag 
    3) Within the link that should cause the H3 to be selected, add an OnClick handler  
       and specify the ID

    Example usage:

    <a href="#users" OnClick="highlight_h3('users');">click here to see users</a>
    <a name="users"></a>
    <h3 id="users">Understanding users</h3>

*/
function highlight_h3(selected_id) { 
    alert('in hightlight_h3 with selected id ' + selected_id) ; 
    $('h3.selected').toggleClass('selected') ; 
    $('h3#' + selected_id).toggleClass('selected') ; 
}





