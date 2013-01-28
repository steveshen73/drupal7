function getParameterByName(name) {

    var match = RegExp('[?&]' + name + '=([^&]*)')
                    .exec(window.location.search);

    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}


$(document).ready(function(){

    //alert('in contact.js document.ready') ; 

    var product = getParameterByName('product') ; 
    var comments = getParameterByName('comments') ;
	var subject = getParameterByName('subject');

    //alert('in contact.js with product ' + product + ' and comments ' + comments) ; 

    if (product == 'chemistry-labacus') { 
	$('#interest-chemistry-labacus').attr('checked', true);
    }
    if (product == 'protocol-labacus') { 
	$('#interest-protocol-labacus').attr('checked', true);
    }
    if (product == 'enterprise-portal') { 
	$('#interest-enterprise-portal').attr('checked', true);
    }
    if (product == 'consulting-services') { 
	$('#interest-consulting-services').attr('checked', true);
    }
	if (product == 'all') { 
	$('#interest-chemistry-labacus').attr('checked', true);
	$('#interest-protocol-labacus').attr('checked', true);
	$('#interest-enterprise-portal').attr('checked', true);
	}

    $('#MsgBody').val(comments); 
	$('#Subj').val(subject);

});
