  function divAdvert_onMouseOver()
    {
        var divAdvert = document.getElementById("divAdvert");
        divAdvert.className = "newStyle";
       
    }

    function divAdvert_onMouseOut()
    {
        var divAdvert = document.getElementById("divAdvert");
        divAdvert.className = "defaultStyle";
       

    }
    window.onload = function(){

      divAdvert_onMouseOver();
      //divAdvert_onMouseOut();
    
    }
