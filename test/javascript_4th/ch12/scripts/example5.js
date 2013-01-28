 
    function addLoadEvent(func)
    {
        var originLoad = window.load;
        if(typeof window.load != 'function')
        {
           window.load = func;
        }
        else {
                window.load = function(){
                   originLoad();
                   func();
                }
             }


    }

