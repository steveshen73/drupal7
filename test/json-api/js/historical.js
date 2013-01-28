
function restart_panels(panel_ids,new_start_id) {

    alert('restarting panels at ' + new_start_id) ; 
    for (index in panel_ids) { 
	if ( panel_ids[index] != new_start_id ) { $('#' + panel_ids[index]).css('display','none') ;  } 
    }
    alert('in restart_panels, showing ' + new_start_id) ; 
    //$('#' + new_start_id).show() ; 
}

function swap_panels(old_panel_id,new_panel_id) {
    alert('in swap_panels, hiding ' + old_panel_id + ' and showing ' + new_panel_id) ; 
    $('#' + old_panel_id).css('display','none') ;
    $('#' + new_panel_id).css('display','block') ;
}


